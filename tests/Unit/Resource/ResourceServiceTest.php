<?php

namespace Unit\Resource;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Resource\Data\ResourceData;
use Modules\Resource\Models\Resource;
use Modules\Resource\Services\ResourceService;
use Tests\TestCase;

class ResourceServiceTest extends TestCase
{
    use RefreshDatabase;

    private ResourceService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(ResourceService::class);
    }

    /** @test */
    public function it_creates_resource_via_data(): void
    {
        $data = ResourceData::from([
            'name' => 'Test Room',
            'type' => 'room',
            'description' => 'Test Desc',
        ]);

        $resource = $this->service->create($data);

        $this->assertDatabaseHas('resources', [
            'id' => $resource->id,
            'name' => 'Test Room',
        ]);
    }

    /** @test */
    public function it_lists_all_resources(): void
    {
        Resource::factory()->count(3)->create();

        $all = $this->service->all();
        $this->assertCount(3, $all);
    }
}
