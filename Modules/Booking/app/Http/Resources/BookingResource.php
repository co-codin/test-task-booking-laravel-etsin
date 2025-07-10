<?php

namespace Modules\Booking\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Resource\Http\Resources\ResourceResource;

/**
 * @OA\Schema(
 *     schema="BookingResource",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=2),
 *     @OA\Property(property="start_time", type="string", format="date-time", example="2025-07-10T10:00:00Z"),
 *     @OA\Property(property="end_time", type="string", format="date-time", example="2025-07-10T11:00:00Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-10T09:00:00Z"),
 *     @OA\Property(property="resource", ref="#/components/schemas/ResourceResource")
 * )
 */
class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'resource' => new ResourceResource($this->resource),
            'user_id' => $this->user_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_at' => $this->created_at,
        ];
    }
}
