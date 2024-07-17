<?php

namespace App\Http\Controllers\APIControllers;


use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APICategoryController extends BaseAPIController
{
 /**
 * @OA\Get(
 *     path="/rest/categories",
 *     summary="Get all categories",
 *     description="Returns a list of all categories",
 *     tags={"Categories"},
 *     @OA\Response(
 *         response=200,
 *         description="List of categories",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/CategoryResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No categories found"
 *     )
 * )
 */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

/**
 * @OA\Get(
 *     path="/rest/categories/id/{id}",
 *     summary="Get category by ID",
 *     description="Returns a single category by ID",
 *     tags={"Categories"}, 
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the category",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category details",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/CategoryResource"
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Category not found"
 *     )
 * )
 */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
