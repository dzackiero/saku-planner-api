<?php

namespace App\Data\Wallet;

use App\Enums\WalletType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateWalletData extends Data
{
    public function __construct(
        public string|Optional $name,
        public WalletType|Optional $type,
        public float|Optional $balance,
    ) {
    }
}
