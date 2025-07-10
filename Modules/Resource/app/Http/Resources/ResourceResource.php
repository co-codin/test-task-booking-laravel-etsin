<?php

namespace Modules\Resource\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ResourceResource",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Conference Room"),
 *     @OA\Property(property="type", type="string", example="room"),
 *     @OA\Property(property="description", type="string", example="Main hall with projector")
 * )
 */
class ResourceResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
