<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APIProductController extends BaseAPIController
{
/**
 * Display a listing of the resource.
 *
 * @OA\Get(
 *      path="/rest/products",
 *      tags={"Products"},
 *      summary="Display a listing of products",
 *      description="Get a paginated list of products with their details",
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/ProductResource")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Unauthorized",
 *      ),
 * )
 */
    public function index()
    {
        $products = Product::paginate(9);
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

/**
 * @OA\Get(
 *     path="/rest/products/id/{id}",
 *     summary="Show a single product",
 *     description="Display the specified product.",
 *     operationId="showProduct",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the product to show",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Product not found"
 *     )
 * )
 */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

/**
 * @OA\Get(
 *     path="/rest/products/brand/{brandName}",
 *     summary="Get a paginated list of products filtering by brand name",
 *     description="Returns a list of products based on the provided brand name.",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="brandName",
 *         in="path",
 *         description="The name of the brand",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProductResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="The brand doesnt exist"
 *             )
 *         )
 *     ),
 * )
 */
    public function getProductsByBrand(string $brandName)
    {
        $brand = Brand::where('name', $brandName)->firstOrFail();
        $products = Product::where('brand_id', $brand->id)->paginate(9);

        return ProductResource::collection($products);
    }

    /**
 * @OA\Get(
 *     path="/rest/products/category/{categoryName}",
 *     summary="Get a paginated list of products filtering by category name",
 *     description="Returns a list of products based on the provided category name.",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="categoryName",
 *         in="path",
 *         description="The name of the category",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProductResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="The category doesnt exist."
 *             )
 *         )
 *     ),
 * )
 */
    public function getProductsByCategory(string $categoryName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $products = Product::where('category_id', $category->id)->paginate(9);

        return ProductResource::collection($products);
    }


 /**
 * @OA\Get(
 *     path="/rest/products/category/{categoryName}/brand/{brandName}",
 *     summary="Get products by category and brand",
 *     description="Retrieves a paginated list of products belonging to a specific category and brand.",
 *     operationId="getProductsByCategoryAndBrand",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="categoryName",
 *         in="path",
 *         description="Category name",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="brandName",
 *         in="path",
 *         description="Brand name",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of products retrieved successfully",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProductResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="The category or brand doesnt exist."
 *             )
 *         )
 *     ),
 * )
 */
    public function getProductsByCategoryAndBrand(string $categoryName, string $brandName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $brand = Brand::where('name', $brandName)->firstOrFail();
    
        $products = Product::where([
            ['category_id', $category->id],
            ['brand_id', $brand->id],
        ])->paginate(9);
    
        return ProductResource::collection($products);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
