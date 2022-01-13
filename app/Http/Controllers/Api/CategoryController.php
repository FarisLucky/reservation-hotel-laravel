<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Http\Resources\APICollection;
use App\Http\Resources\APIResource;
use App\Models\Categories;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Categories::all();
        return new APICollection($categories);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = Categories::create($request->input('data.attributes'));
        return (new APIResource($category))
            ->response()
            ->header('Location',route('api.categories.show', ['category'=>$category]));
    }

    public function show(Categories $category)
    {
        return new APIResource($category);
    }

    public function update(UpdateCategoryRequest $request, Categories $category)
    {
        $category->update($request->input('data.attributes'));
        return new APIResource($category);
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
