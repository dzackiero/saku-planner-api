<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class TargetData extends Data
{
    public function __construct(


        public string $id,
        public int $duration,
        public string $start_date,
        public float $target_amount,

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {}
}
