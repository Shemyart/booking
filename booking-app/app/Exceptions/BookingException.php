<?php

namespace App\Exceptions;

use Exception;
class BookingException extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => "Choosen date is busy"
        ], 400);
    }
}
