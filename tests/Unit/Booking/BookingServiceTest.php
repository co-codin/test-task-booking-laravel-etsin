<?php

namespace Unit\Booking;

use Modules\Booking\Data\BookingData;
use Modules\Booking\Models\Booking;
use Modules\Booking\Services\BookingService;
use Modules\Resource\Models\Resource;
use Modules\User\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    private BookingService $service;
    private Resource $resource;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service  = $this->app->make(BookingService::class);
        $this->resource = Resource::factory()->create();
        $this->user     = User::factory()->create();
    }

    /** @test */
    public function it_creates_booking_via_data(): void
    {
        $dto = BookingData::from([
            'resource_id' => $this->resource->id,
            'user_id'     => $this->user->id,
            'start_time'  => now()->toDateTimeString(),
            'end_time'    => now()->addHour()->toDateTimeString(),
        ]);

        $booking = $this->service->create($dto);

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertDatabaseHas('bookings', [
            'id'          => $booking->id,
            'resource_id' => $this->resource->id,
        ]);
    }

    /** @test */
    public function it_deletes_booking(): void
    {
        $booking = Booking::factory()->for($this->resource)->for($this->user)->create();

        $this->service->delete($booking->id);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }
}
