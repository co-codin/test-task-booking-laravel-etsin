<?php

namespace Modules\Resource\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Booking\Http\Resources\BookingResource;
use Modules\Resource\DTO\ResourceData;
use Modules\Resource\Http\Requests\StoreResourceRequest;
use Modules\Resource\Http\Resources\ResourceResource;
use Modules\Resource\Services\ResourceService;

class ResourceController extends Controller
{
    public function __construct(private ResourceService $service) {}

    public function store(StoreResourceRequest $request)
    {
        $data = ResourceData::from($request->validated());
        $resource = $this->service->create($data);

        return new ResourceResource($resource);
    }

    public function index()
    {
        return ResourceResource::collection($this->service->all());
    }

    public function bookings(int $id)
    {
        return BookingResource::collection($this->service->getBookings($id));
    }
}
