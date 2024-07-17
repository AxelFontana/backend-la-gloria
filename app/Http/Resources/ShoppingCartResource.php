<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * 
 * Represents a shopping cart resource in the application.
 * 
 * @OA\Schema(
 *     schema="ShoppingCartResource",
 *     type="object",
 *     title="ShoppingCartResource",
 *     description="Represents a Shopping cart",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="total_price",
 *         type="number",
 *         format="float",
 *         example=99.99
 *     ),
 *     @OA\Property(
 *         property="date",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-12T15:30:00Z"
 *     ),
 *     @OA\Property(
 *         property="client",
 *         ref="#/components/schemas/ClientResource"
 *     ),
 *     @OA\Property(
 *         property="orders_detail",
 *         type="array",
 *         @OA\Items(
 *             ref="#/components/schemas/OrderDetailResource"
 *         )
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-12T15:30:00Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-12T15:30:00Z"
 *     )
 * )
 **/
class ShoppingCartResource extends JsonResource
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
            'total_price' => $this->total_price,
            'date' => $this->date,
            'client' => new ClientResource($this->client),
            'orders_detail' => OrderDetailResource::collection($this->ordersDetail),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
