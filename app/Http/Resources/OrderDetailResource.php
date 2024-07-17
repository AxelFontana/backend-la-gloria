<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="OrderDetailResource",
 *     type="object",
 *     title="Order Detail Resource",
 *     description="Represents an Order detail",
 *     @OA\Property(
 *         property="id",
 *         description="The ID of the order detail",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="product_amount",
 *         description="The amount of the product in the order detail",
 *         type="integer",
 *         example=3
 *     ),
 *     @OA\Property(
 *         property="product",
 *         description="The product in the order detail",
 *         ref="#/components/schemas/ProductResource"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         description="The date and time when the order detail was created",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-12 14:30:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         description="The date and time when the order detail was last updated",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-12 14:32:00"
 *     )
 * )
 */
class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_amount' => $this->product_amount,
            'product' => new ProductResource($this->product),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
