<?php

namespace App\Containers\AppSection\Group\Data\Factories;

use App\Containers\AppSection\Group\Models\Group;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class GroupFactory extends ParentFactory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
