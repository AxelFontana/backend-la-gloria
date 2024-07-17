<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * Represents a product resource in the application.
 *
 * @OA\Schema(
 *     schema="ProductResource",
 *     title="ProductResource",
 *     type="object",
 *     description="Represents a Product",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The product's unique identifier"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the product"
 *     ),
 *     @OA\Property(
 *         property="size",
 *         type="string",
 *         description="The size of the product"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         description="The URL of the product's image"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="number",
 *         format="float",
 *         description="The price of the product"
 *     ),
 *     @OA\Property(
 *         property="enable",
 *         type="boolean",
 *         description="The enabled state of the product"
 *     ),
 *     @OA\Property(
 *         property="stock",
 *         type="number",
 *         format="integer",
 *         description="The stock of the product"
 *     ),
 *     @OA\Property(
 *         property="brand",
 *         ref="#/components/schemas/BrandResource",
 *         description="The brand of the product"
 *     ),
 *     @OA\Property(
 *         property="category",
 *         ref="#/components/schemas/CategoryResource",
 *         description="The category of the product"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time when the product was created"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time when the product was last updated"
 *     ),
 * )
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'size' => $this->size,
            'image' => $this->image,
            'price' => $this->price,
            'enable' => $this->enable,
            'stock' => $this->stock,
            'brand' => new BrandResource($this->brand),
            'category' => new CategoryResource($this->category),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
