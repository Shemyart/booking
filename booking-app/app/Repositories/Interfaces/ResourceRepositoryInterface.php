<?php
namespace App\Repositories\Interfaces;

use App\Models\Resource;
interface ResourceRepositoryInterface
{
    public function all();

    public function getById($resourceId);
}
