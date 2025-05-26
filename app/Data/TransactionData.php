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

        public ?string $synced_at = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
        public ?string $deleted_at = null
    ) {
    }
}
