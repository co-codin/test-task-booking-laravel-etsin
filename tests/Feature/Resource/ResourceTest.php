<?php

namespace Feature\Resource;


use Modules\Resource\Models\Resource;
use Modules\User\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_and_lists_resources(): void
    {
        $payload = [
            'name'        => 'Room A',
            'type'        => 'room',
            'description' => 'Конференц-зал',
        ];

        $this->postJson('/api/resources', $payload)
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'Room A',
                'type' => 'room',
            ]);

        $this->getJson('/api/resources')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Room A');
    }

    /** @test */
    public function it_returns_bookings_for_resource(): void
    {
        $resource = Resource::factory()->create();
        $user     = User::factory()->create();

        $bookingData = [
            'resource_id' => $resource->id,
            'user_id'     => $user->id,
            'start_time'  => now()->addHour()->toDateTimeString(),
            'end_time'    => now()->addHours(2)->toDateTimeString(),
        ];

        $this->postJson('/api/bookings', $bookingData)->assertStatus(201);

        $this->getJson("/api/resources/{$resource->id}/bookings")
            ->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.resource.id', $resource->id);
    }
}
