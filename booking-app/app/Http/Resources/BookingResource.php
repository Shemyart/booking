<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\ResponseField;

class BookingResource extends JsonResource
{
    #[ResponseField('id', 'integer', required: true)]
    #[ResponseField('resource_id', 'integer', required: true)]
    #[ResponseField('user_id', 'integer', required: true)]
    #[ResponseField('start_time', 'string', required: true)]
    #[ResponseField('end_time', 'string', required: true)]
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'resource'      => new ResourceResource($this->whenLoaded('resource')),
            'user'          => new UserResource($this->whenLoaded('user'))
        ];
    }
}
