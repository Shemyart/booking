<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Booking;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Resource $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user     = User::factory()->create();
        $this->resource = Resource::factory()->create();
    }

    /** @test */
    public function it_creates_booking_successfully()
    {
        $response = $this->postJson('/api/v1/bookings', [
            'resource_id'   => $this->resource->id,
            'user_id'       => $this->user->id,
            'start_time'    => now()->addHours(1)->toDateTimeString(),
            'end_time'      => now()->addHours(2)->toDateTimeString(),
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function it_not_create_booking_by_time()
    {
        // Создаём первое бронирование
        Booking::factory()->create([
            'resource_id'   => $this->resource->id,
            'user_id'       => $this->user->id,
            'start_time'    => now()->addHours(1),
            'end_time'      => now()->addHours(2),
        ]);

        // Пытаемся забронировать тот же ресурс в то же время
        $response = $this->postJson('/api/v1/bookings', [
            'resource_id'   => $this->resource->id,
            'user_id'       => $this->user->id,
            'start_time'    => now()->addHours(1)->toDateTimeString(),
            'end_time'      => now()->addHours(2)->toDateTimeString(),
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Choosen date is busy'
            ]);
    }

    /** @test */
    public function it_gets_all_bookings_by_resource()
    {
        // Создаём несколько бронирований
        Booking::factory()->count(3)->create([
            'resource_id' => $this->resource->id
        ]);

        $response = $this->getJson("/api/v1/resources/{$this->resource->id}/bookings");

        $response->assertOk();
    }

    /** @test */
    public function it_deleted_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->deleteJson("/api/v1/bookings/{$booking->id}");

        $response->assertOk();
    }
}
