<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public const array ALL_RELATIONS = [
        'resource',
        'user',
    ];

    public function destroy($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return $booking->delete();
    }

    public function all()
    {
        return Booking::with(self::ALL_RELATIONS)->get();
    }
}
