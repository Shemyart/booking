<?php

namespace Database\Seeders;

use App\Models\Resource;

class ResourceSeeder
{
    public function run(): void
    {
        Resource::factory()->count(10)->create();
    }
}
