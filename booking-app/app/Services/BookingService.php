<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use App\Models\Booking;

class BookingService
{
    public function checkAvailiable($params)
    {
        $startTime = Carbon::parse($params['start_time']);
        $endTime = Carbon::parse($params['end_time']);
        $resourceId = $params['resource_id'];

        return !Booking::where('resource_id', $resourceId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })->exists();
    }
}
