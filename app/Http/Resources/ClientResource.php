<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ClientResource",
 *     title="ClientResource",
 *     type="object",
 *     description="Represents a Client",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The client ID",
 *         example="3"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="The client email",
 *         example="john.doe@gmail.com"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The datetime when the client was created"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The datetime when the client was last updated"
 *     ),
 * )
 */
class ClientResource extends JsonResource
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
            'email' => $this->email,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
