<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Resource;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = Carbon::now()
            ->addDays($this->faker->numberBetween(1, 30))
            ->setHour($this->faker->numberBetween(8, 18))
            ->minute(0);
        $endTime = (clone $startTime)->addHours($this->faker->numberBetween(1, 4));

        return [
            'resource_id'   => Resource::factory(),
            'user_id'       => User::factory(),
            'start_time'    => $startTime,
            'end_time'      => $endTime,
        ];
    }
}
