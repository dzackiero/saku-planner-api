<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class BudgetData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty(property: 'id')]
        public int $user_id,

        public string $id,
        #[Exists(table: 'categories', column: 'id')]
        public ?string $category_id = null,
        public string $amount,
        public string $initial_amount,

        public ?string $synced_at = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
        public ?string $deleted_at = null
    ) {}
}
