<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\ResponseField;

class UserResource extends JsonResource
{
    #[ResponseField('id', 'integer', required: true)]
    #[ResponseField('name', 'string', required: true)]
    #[ResponseField('email', 'string', required: true)]
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
        ];
    }
}
