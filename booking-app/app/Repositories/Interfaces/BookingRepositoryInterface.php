<?php
namespace App\Repositories\Interfaces;
interface BookingRepositoryInterface
{
    public function destroy($bookingId);
    public function all();
}
