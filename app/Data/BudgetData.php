<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class BudgetData extends Data
{
    public function __construct(


        public string $id,
        public ?string $category_id = null,
        public float $amount,
        public float $initial_amount,

        public ?string $synced_at = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
        public ?string $deleted_at = null
    ) {}
}
