<?php

namespace App\Services;

use App\Data\Saving\CreateSavingData;
use App\Data\Saving\UpdateSavingData;
use App\Http\Resources\Saving\SavingResource;
use App\Models\Saving;

class SavingService
{
  public function createSaving(CreateSavingData $formData)
  {
    $saving = Saving::create($formData->toArray());
    return $saving->refresh();
  }

  public function getAllSavings()
  {
    $search = request('search');
    $page = request('page', 1);
    $perPage = request('per-page', 15);
    $orderBy = request('order', 'created_at');
    $direction = request('direction', 'desc');

    $savings = Saving::query()
      ->with(['wallet'])
      ->withCount(['wallet.savings'])
      ->when($search, function ($query) use ($search) {
        $query->where('name', 'like', "%$search%");
      })
      ->orderBy($orderBy, $direction)
      ->paginate(perPage: $perPage, page: $page)
      ->withQueryString();

    $savings = SavingResource::collection($savings);
    return $savings->resource;
  }

  public function getSaving(Saving $saving)
  {
    return $saving->load(['wallet']);
  }

  public function updateSaving(Saving $saving, UpdateSavingData $formData)
  {
    $saving->update($formData->toArray());
    return $saving->refresh();
  }

  public function deleteSaving(Saving $saving)
  {
    $saving->delete();
  }
}
