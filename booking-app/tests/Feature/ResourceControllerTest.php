<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Resource;
use App\Models\Booking;
use App\Models\User;

class ResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_resources_list()
    {
        Resource::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/resources');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_resource()
    {
        $params = [
            'name' => 'New Room',
            'type' => 'Room',
            'description' => 'A nice room for booking',
        ];

        $response = $this->postJson('/api/v1/resources', $params);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_returns_bookings_resource()
    {
        $resource = Resource::factory()->create();

        Booking::factory()->create(['resource_id' => $resource->id]);

        $response = $this->getJson("/api/v1/resources/{$resource->id}/bookings");

        $response->assertStatus(200);
    }

    /** @test */
    public function it_returns_error_not_found_booking()
    {
        $response = $this->getJson('/api/v1/resources/999/bookings');

        $response->assertStatus(404);
    }
}
