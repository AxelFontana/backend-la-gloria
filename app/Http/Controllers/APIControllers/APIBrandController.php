<?php

namespace App\Http\Controllers\APIControllers;

use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APIBrandController extends BaseAPIController
{
/**
 * @OA\Get(
 *     path="/rest/brands",
 *     tags={"Brand"},
 *     summary="Get all brands",
 *     description="Returns a list of all brands",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/BrandResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found"
 *     )
 * )
 */
public function index()
{
    $brands = Brand::all();

    return BrandResource::collection($brands);
}


 /**
 * @OA\Get(
 *     path="/rest/brands/id/{id}",
 *     tags={"Brand"},
 *     summary="Get a brand by ID",
 *     description="Returns a single brand by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the brand",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/BrandResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Brand not found"
 *     )
 * )
 */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return new BrandResource($brand);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Brand $brand)
    {
        //
    }

    public function destroy(Brand $brand)
    {
        //
    }
}
