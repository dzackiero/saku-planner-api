<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty(property: 'id')]
        public int $user_id,

        public string $id,
        public string $name,
        public ?string $icon = null,
        public string $type,

        public ?Carbon $synced_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {
    }
}
