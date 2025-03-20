<?php

namespace App\Repositories\Eloquent;

use App\Models\Resource;
use App\Repositories\Interfaces\ResourceRepositoryInterface;

class ResourceRepository implements ResourceRepositoryInterface
{

     public const array ALL_RELATIONS = [
         'bookings'
     ];

     public function all()
     {
         return Resource::all();
     }

     public function getById($resourceId)
     {
         $query = Resource::query();

         return $query->findOrFail($resourceId);
     }

     public function store($params)
     {
         return Resource::create($params);
     }
}
