<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\ResponseField;

class ResourceResource extends JsonResource
{
    #[ResponseField('id', 'integer', required: true)]
    #[ResponseField('name', 'string', required: true)]
    #[ResponseField('type', 'string', required: true)]
    #[ResponseField('description', 'string', required: true)]
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
        ];
    }
}
