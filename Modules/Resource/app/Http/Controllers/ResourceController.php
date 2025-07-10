<?php

namespace Modules\Resource\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Resource\Http\Requests\StoreResourceRequest;
use Modules\Resource\Http\Resources\ResourceResource;

class ResourceController extends Controller
{
    public function store(StoreResourceRequest $request)
    {
        $resource = ResourceResource::create($request->validated());

        return new ResourceResource($resource);
    }

    public function index()
    {
        return ResourceResource::collection(Resource::all());
    }

    public function bookings(int $id)
    {
        $resource = Resource::findOrFail($id);

        return BookingResource::collection($resource->bookings);
    }
}
