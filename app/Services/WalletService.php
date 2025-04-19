<?php

namespace App\Services;

use App\Data\Wallet\CreateWalletData;
use App\Data\Wallet\UpdateWalletData;
use App\Models\Wallet;

class WalletService
{
  public function createWallet(CreateWalletData $formData)
  {
    $wallet = Wallet::create($formData->toArray());
    return $wallet->refresh();
  }
  public function getAllWallets()
  {
    $page = request('page', 1);
    $perPage = request('per-page', 15);
    $query = request('search');
    $orderBy = request('order', 'created_at');
    $direction = request('direction', 'desc');

    $wallets = Wallet::query()
      ->where('name', 'like', "%$query%")
      ->orderBy($orderBy, $direction)
      ->paginate(perPage: $perPage, page: $page)
      ->withQueryString();

    return $wallets;
  }

  public function getWallet(Wallet $wallet)
  {
    return $wallet;
  }

  public function updateWallet(Wallet $wallet, UpdateWalletData $formData)
  {
    $wallet->update($formData->toArray());
    return $wallet->refresh();
  }

  public function deleteWallet(Wallet $wallet)
  {
    $wallet->delete();
  }
}
