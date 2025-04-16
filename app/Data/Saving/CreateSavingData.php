<?php

namespace App\Data\Saving;

use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class CreateSavingData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty('id')]
        public string $user_id,

        #[Exists('wallets', 'id')]
        public string $wallet_id,

        public string $name,
        #[Min(0)]
        public float $target,
        #[Min(1)]
        public int $target_months = 1,
    ) {
    }
}
