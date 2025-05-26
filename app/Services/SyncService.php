<?php

namespace App\Services;

use App\Data\Sync\SyncData;
use DB;
use Spatie\LaravelData\Data;

class SyncService
{
  public function sync(SyncData $syncData)
  {
    DB::beginTransaction();
    try {
      $serverNow = now();

      foreach ($syncData->accounts as $account) {
        $this->processItem(\App\Models\Account::class, $account);
      }

      foreach ($syncData->budgets as $budget) {
        $this->processItem(\App\Models\Budget::class, $budget);
      }

      foreach ($syncData->categories as $category) {
        $this->processItem(\App\Models\Category::class, $category);
      }

      foreach ($syncData->monthBudgets as $monthBudget) {
        $this->processItem(\App\Models\MonthBudget::class, $monthBudget);
      }

      foreach($syncData->targets as $target) {
        $this->processItem(\App\Models\Target::class, $target);
      }
      
      foreach ($syncData->transactions as $transaction) {
        $this->processItem(\App\Models\Transaction::class, $transaction);
      }



    } catch (\Exception $e) {
      DB::rollBack();
      return "Error during synchronization: " . $e->getMessage();
    }
    DB::commit();
    return "Data synchronized successfully!";
  }

  public function processItem(string $modelClass, Data $dataObject)
  {
    $id = $dataObject->id ?? null;
    if (!$id)
      return "ID is required for synchronization.";
    $createdAt = $dataObject->created_at ?? null;
    if (!$createdAt)
      return "Created at timestamp is required for synchronization.";
    $updatedAt = $dataObject->updated_at ?? null;
    if (!$updatedAt)
      return "Updated at timestamp is required for synchronization.";
    $deletedAt = $dataObject->deleted_at ?? null;

    $data = $dataObject->toArray();
    if ($deletedAt) {
      $item = $modelClass::withTrashed()->find($id);
      if (!$item->isTrashed()) {
        $item->delete();
      }
    } else {
      unset($data['deleted_at']);
      $item = $modelClass::updateOrCreate([
        'id' => $id,
      ], $data);

      if ($item->trashed()) {
        $item->restore();
      }
    }

  }
}
