<?php

namespace App\Containers\AppSection\Area\Data\Factories;

use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class AreaFactory extends ParentFactory
{
    protected $model = Area::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
