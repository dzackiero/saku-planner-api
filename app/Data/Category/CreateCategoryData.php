<?php

namespace App\Data\Category;

use App\Enums\CategoryType;
use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Data;

class CreateCategoryData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty(property: 'id')]
        public int $user_id,
        public string $name,
        public CategoryType $type,
    ) {
    }
}
