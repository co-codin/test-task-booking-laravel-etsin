<?php

namespace Modules\Resource\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
