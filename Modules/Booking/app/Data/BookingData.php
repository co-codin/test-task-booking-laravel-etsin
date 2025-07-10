<?php

namespace Modules\Booking\Data;

use Spatie\LaravelData\Data;

class BookingData extends Data
{
    public function __construct(
        public int $resource_id,
        public int $user_id,
        public string $start_time,
        public string $end_time
    ) {}
}
