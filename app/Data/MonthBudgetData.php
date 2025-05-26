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

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {}
}
