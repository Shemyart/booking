<?php

namespace Database\Seeders;

use App\Models\Resource;

class ResourceSeeder
{
    public function run(): void
    {
        $resourceArray = [
            [
                'name'          => 'Test1',
                'type'          => 'car',
                'description'   => 'test description 1',
            ],
            [
                'name'          => 'Test2',
                'type'          => 'car',
                'description'   => 'test description 2',
            ],
            [
                'name'          => 'Test3',
                'type'          => 'car',
                'description'   => 'test description 3',
            ],
            [
                'name'          => 'Test4',
                'type'          => 'car',
                'description'   => 'test description 4',
            ],
            [
                'name'          => 'Test5',
                'type'          => 'car',
                'description'   => 'test description 5',
            ],
            [
                'name'          => 'Test6',
                'type'          => 'car',
                'description'   => 'test description 6',
            ],

        ];
        foreach ($resourceArray as $resource){
            Resource::factory()->create($resource);
        }
    }
}
