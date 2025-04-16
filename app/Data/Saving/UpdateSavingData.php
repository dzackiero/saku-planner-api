<?php

namespace App\Data\Saving;

use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateSavingData extends Data
{
    public function __construct(
        #[Exists('wallets', 'id'), Nullable]
        public string|Optional $wallet_id,
        #[Nullable]
        public string|Optional $name,
        #[Min(0), Nullable]
        public float|Optional $target,
        #[Min(1), Nullable]
        public int|Optional $target_months = 1,
    ) {
    }
}
