<?php

namespace App\Services;

use App\Data\Category\CreateCategoryData;
use App\Data\Category\UpdateCategoryData;
use App\Models\Category;

class CategoryService
{
  public function createCategory(CreateCategoryData $formData): Category
  {
    $formData = collect($formData->toArray())->put('user_id', auth()->id());
    $category = Category::create($formData->toArray());
    return $category->refresh();
  }

  public function getAllCategories()
  {
    $page = request('page', 1);
    $perPage = request('per-page', 15);
    $query = request('search', "");
    $orderBy = request('order', 'created_at');
    $direction = request('direction', 'desc');

    $categories = Category::query()
      ->where('name', 'like', "%$query%")
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
