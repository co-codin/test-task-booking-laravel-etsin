<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Booking\Data\BookingData;
use Modules\Booking\Http\Requests\StoreBookingRequest;
use Modules\Booking\Http\Resources\BookingResource;
use Modules\Booking\Services\BookingService;

class BookingController extends Controller
{
    public function __construct(private BookingService $service) {}

    public function store(StoreBookingRequest $request)
    {
        $data = BookingData::from($request->validated());
        $booking = $this->service->create($data);

        return new BookingResource($booking);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->json(null, 204);
    }
}
