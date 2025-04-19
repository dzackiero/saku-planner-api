<?php

namespace App\Services;

use App\Data\Category\CreateCategoryData;
use App\Data\Category\UpdateCategoryData;
use App\Models\Category;

class CategoryService
{
  public function createCategory(CreateCategoryData $formData): Category
  {
    $category = Category::create($formData->toArray());
    return $category->refresh();
  }

  public function getAllCategories()
  {
    $search = request('search');
    $page = request('page', 1);
    $perPage = request('per-page', 15);
    $orderBy = request('order', 'created_at');
    $direction = request('direction', 'desc');

    $categories = Category::query()
      ->when($search, function ($query) use ($search) {
        $query->where('name', 'like', "%$search%");
      })
      ->orderBy($orderBy, $direction)
      ->paginate(perPage: $perPage, page: $page)
      ->withQueryString();

    return $categories;
  }

  public function getCategory(Category $category): Category
  {
    return $category;
  }

  public function updateCategory(Category $category, UpdateCategoryData $formData): Category
  {
    $category->update($formData->toArray());
    return $category->refresh();
  }

  public function deleteCategory(Category $category): void
  {
    $category->delete();
  }
}
