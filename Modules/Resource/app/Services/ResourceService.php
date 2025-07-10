<?php

namespace Modules\Resource\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Resource\Data\ResourceData;
use Modules\Resource\Models\Resource;

class ResourceService
{
    public function create(ResourceData $data): Resource
    {
        return Resource::query()->create($data->toArray());
    }

    public function all(): Collection
    {
        return Resource::all();
    }

    public function getBookings(int $resourceId)
    {
        return Resource::query()->findOrFail($resourceId)->bookings;
    }
}
