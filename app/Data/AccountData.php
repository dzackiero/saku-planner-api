<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class AccountData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public float $balance,
        public ?string $description = null,
        public ?string $target_id = null,

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {
    }
}
