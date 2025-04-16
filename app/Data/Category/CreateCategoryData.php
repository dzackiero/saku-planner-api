<?php

namespace App\Data\Category;

use App\Enums\CategoryType;
use Spatie\LaravelData\Data;

class CreateCategoryData extends Data
{
    public function __construct(
        public string $name,
        public CategoryType $type,
    ) {
    }
}
