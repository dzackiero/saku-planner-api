<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class TransactionData extends Data
{
    public function __construct(


        public string $id,
        public string $account_id,
        public string $category_id,
        public ?string $to_account_id = null,
        public string $type,
        public ?string $kakeibo_category = null,

        public float $amount,
        public ?string $description = null,

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {
    }
}
