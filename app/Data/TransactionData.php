<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Data;

class TransactionData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty(property: 'id')]
        public int $user_id,

        public string $id,
        #[Exists(table: 'accounts', column: 'id')]
        public string $account_id,
        #[Exists(table: 'categories', column: 'id')]
        public string $category_id,
        #[Exists(table: 'accounts', column: 'id')]
        public ?string $to_account_id = null,
        public string $type,
        public string $kakeibo_category,

        public string $amount,
        public ?string $description = null,

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {
    }
}
