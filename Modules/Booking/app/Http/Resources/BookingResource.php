<?php

namespace Modules\Booking\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Resource\Http\Resources\ResourceResource;

class BookingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'resource'   => new ResourceResource($this->resource),
            'user_id'    => $this->user_id,
            'start_time' => $this->start_time,
            'end_time'   => $this->end_time,
            'created_at' => $this->created_at,
        ];
    }
}
