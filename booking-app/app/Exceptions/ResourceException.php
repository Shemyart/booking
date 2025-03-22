<?php

namespace App\Exceptions;

use Exception;
class ResourceException extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => "Choosen resource not found"
        ], 400);
    }
}
