<?php

namespace App\Data\Wallet;

use App\Enums\WalletType;
use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Data;

class CreateWalletData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty('id')]
        public string $user_id,

        public string $name,
        public WalletType $type = WalletType::General,
        public float $balance = 0,
    ) {
    }
}
