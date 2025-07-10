<?php

namespace Feature\Booking;

use Modules\Booking\Models\Booking;
use Modules\Resource\Models\Resource;
use Modules\User\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_creating_and_deleting_booking_and_detects_conflict(): void
    {
        $resource = Resource::factory()->create();
        $user     = User::factory()->create();

        $payload = [
            'resource_id' => $resource->id,
            'user_id'     => $user->id,
            'start_time'  => now()->addHour()->toDateTimeString(),
            'end_time'    => now()->addHours(2)->toDateTimeString(),
        ];

        $this->postJson('/api/bookings', $payload)
            ->assertStatus(201)
            ->assertJsonPath('data.resource.id', $resource->id);

        $this->postJson('/api/bookings', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors('start_time');

        $id = Booking::first()->id;
        $this->deleteJson("/api/bookings/{$id}")
            ->assertStatus(204);

        $this->postJson('/api/bookings', $payload)
            ->assertStatus(201);
    }
}
