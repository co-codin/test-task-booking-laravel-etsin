<?php

namespace Modules\Booking\Services;

use Modules\Booking\Data\BookingData;
use Modules\Booking\Models\Booking;

class BookingService
{
    public function create(BookingData $data): Booking
    {
        return Booking::query()->create($data->toArray());
    }

    public function delete(int $id): void
    {
        Booking::query()->findOrFail($id)->delete();
    }
}
