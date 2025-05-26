<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class MonthBudgetData extends Data
{
    public function __construct(


        public string $id,
        public string $budget_id,
        public int $year,
        public int $month,
        public float $amount,

        public ?string $synced_at = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
        public ?string $deleted_at = null
    ) {
    }
}
