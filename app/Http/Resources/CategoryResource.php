<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     schema="CategoryResource",
 *     title="Category Resource",
 *     type="object",
 *     description="Represents a category",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The ID of the category",
 *         example="2"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the category",
 *         example="Shoes"
 *     ),
 *     @OA\Property(
 *         property="enable",
 *         type="boolean",
 *         description="The enabled state of the category"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time when the category was created"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time when the category was last updated"
 *     )
 * )
 */
class CategoryResource extends JsonResource
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
            'enable' => $this->enable,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
