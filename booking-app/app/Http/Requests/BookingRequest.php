<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resource_id'   => 'required|exists:resources,id',
            'user_id'       => 'required|integer',
            'start_time'    => 'required|date',
            'end_time'      => 'required|date|after:start_time',
        ];
    }

}
