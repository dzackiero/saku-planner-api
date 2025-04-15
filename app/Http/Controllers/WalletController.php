<?php

namespace App\Http\Controllers;

use App\Data\Wallet\CreateWalletData;
use App\Data\Wallet\UpdateWalletData;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(WalletService $service)
    {
        $wallets = $service->getAllWallets();
        return $this->successResponse(
            $wallets,
        );
    }

    public function store(WalletService $service, CreateWalletData $formData)
    {
        $wallet = $service->createWallet($formData);
        return $this->successResponse(
            data: $wallet,
        );
    }

    public function show(WalletService $service, Wallet $wallet)
    {
        $wallet = $service->getWallet($wallet);
        return $this->successResponse(
            data: $wallet,
        );
    }

    public function update(WalletService $service, UpdateWalletData $request, Wallet $wallet)
    {
        $wallet = $service->updateWallet($wallet, $request);
        return $this->successResponse(
            data: $wallet,
        );
    }

    public function destroy(WalletService $service, Wallet $wallet)
    {
        $service->deleteWallet($wallet);
        return $this->successResponse();
    }
}
