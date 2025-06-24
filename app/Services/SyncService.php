<?php

namespace App\Services;

use DB;
use App\Data\Sync\SyncData;
use App\Models\Account;
use App\Models\Budget;
use App\Models\Category;
use App\Models\MonthBudget;
use App\Models\Target;
use App\Models\Transaction;
use Spatie\LaravelData\Data;

class SyncService
{
  public function getSyncData()
  {
    $userId = auth()->id();
    return [
      'accounts' => Account::where('user_id', $userId)->get(),
      'budgets' => Budget::where('user_id', $userId)->get(),
      'categories' => Category::where('user_id', $userId)->get(),
      'monthBudgets' => MonthBudget::where('user_id', $userId)->get(),
      'targets' => Target::where('user_id', $userId)->get(),
      'transactions' => Transaction::where('user_id', $userId)->get(),
    ];
  }

  public function sync(SyncData $syncData)
  {
    DB::beginTransaction();
    try {
      foreach ($syncData->accounts as $account) {
        $this->processItem(Account::class, $account);
      }
      Account::whereIn('id', $syncData->deleteAccounts ?? [])
        ->where('user_id', auth()->id())
        ->delete();

      foreach ($syncData->budgets as $budget) {
        $this->processItem(Budget::class, $budget);
      }
      Budget::whereIn('id', $syncData->deleteBudgets ?? [])
        ->where('user_id', auth()->id())
        ->delete();

      foreach ($syncData->categories as $category) {
        $this->processItem(Category::class, $category);
      }
      Category::whereIn('id', $syncData->deleteCategories ?? [])
        ->where('user_id', auth()->id())
        ->delete();

      foreach ($syncData->monthBudgets as $monthBudget) {
        $this->processItem(MonthBudget::class, $monthBudget);
      }
      MonthBudget::whereIn('id', $syncData->deleteMonthBudgets ?? [])
        ->where('user_id', auth()->id())
        ->delete();

      foreach ($syncData->targets as $target) {
        $this->processItem(Target::class, $target);
      }
      Target::whereIn('id', $syncData->deleteTargets ?? [])
        ->where('user_id', auth()->id())
        ->delete();

      foreach ($syncData->transactions as $transaction) {
        $this->processItem(Transaction::class, $transaction);
      }
      Transaction::whereIn('id', $syncData->deleteTransactions ?? [])
        ->where('user_id', auth()->id())
        ->delete();



    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
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

    $userId = auth()->id();
    $data = $dataObject->toArray();
    $data['user_id'] = $userId;
    if ($deletedAt) {
      $item = $modelClass::withTrashed()->find($id);
      if (!$item->trashed()) {
        $item->update([
          'synced_at' => now(),
        ]);
        $item->delete();
      }
    } else {
      $data['synced_at'] = now();
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
