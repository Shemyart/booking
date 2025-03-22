<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\Collection;

class BookingRepository implements BookingRepositoryInterface
{
    public const array ALL_RELATIONS = [
        'resource',
        'user',
    ];

    public function all(): Collection
    {
        return Booking::with(self::ALL_RELATIONS)->get();
    }

    public function destroy($bookingId): bool
    {
        $booking = Booking::findOrFail($bookingId);
        return $booking->delete();
    }
}
