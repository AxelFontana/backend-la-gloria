<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BrandResource",
 *     type="object",
 *     title="Brand resource",
 *     description="Represents a Brand",
 *     @OA\Property(
 *         property="id",
 *         description="The brand's ID",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         description="The brand's name",
 *         type="string",
 *         example="Nike"
 *     ),
 *     @OA\Property(
 *         property="enable",
 *         type="boolean",
 *         description="The enabled state of the brand"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         description="The datetime when the brand was created",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-11 13:42:56"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         description="The datetime when the brand was last updated",
 *         type="string",
 *         format="date-time",
 *         example="2023-05-11 13:42:56"
 *     ),
 * )
 */
class BrandResource extends JsonResource
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
