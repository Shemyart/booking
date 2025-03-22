<?php

namespace App\Repositories\Eloquent;

use App\Models\Resource;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ResourceRepository implements ResourceRepositoryInterface
{

     public const array ALL_RELATIONS = [
         'bookings'
     ];

     public function all(): Collection
     {
         return Resource::all();
     }

     public function getById($resourceId): Resource
     {
         $query = Resource::query();

         return $query->findOrFail($resourceId);
     }

     public function store($params): Resource
     {
         return Resource::create($params);
     }
}
