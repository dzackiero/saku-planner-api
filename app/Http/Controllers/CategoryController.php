<?php

namespace App\Http\Controllers;

use App\Data\Category\CreateCategoryData;
use App\Data\Category\UpdateCategoryData;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryService $service)
    {
        $categories = $service->getAllCategories();
        return $this->successResponse($categories);
    }

    public function store(CategoryService $service, CreateCategoryData $formData)
    {
        $category = $service->createCategory($formData);
        return $this->successResponse($category);
    }

    public function show(CategoryService $service, Category $category)
    {
        $category = $service->getCategory($category);
        return $this->successResponse($category);
    }

    public function update(CategoryService $service, UpdateCategoryData $formData, Category $category)
    {
        $category = $service->updateCategory($category, $formData);
        return $this->successResponse($category);
    }

    public function destroy(CategoryService $service, Category $category)
    {
        $service->deleteCategory($category);
        return $this->successResponse(null, 204);
    }
}
