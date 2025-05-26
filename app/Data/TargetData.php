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

        public ?string $synced_at = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
        public ?string $deleted_at = null
    ) {
    }
}
