<?php

namespace App\Data\Category;

use App\CategoryType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateCategoryData extends Data
{
    public function __construct(
        public string|Optional $name,
        public CategoryType|Optional $type,
    ) {
    }
}
