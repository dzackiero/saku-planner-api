<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class AccountData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty(property: 'id')]
        public int $user_id,

        public string $id,
        public string $name,
        public string $balance,
        public ?string $description = null,

        #[Exists(table: 'targets', column: 'id')]
        public ?string $target_id = null,

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {
    }
}
