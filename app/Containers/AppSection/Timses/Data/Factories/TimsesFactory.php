<?php

namespace App\Containers\AppSection\Timses\Data\Factories;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class TimsesFactory extends ParentFactory
{
    protected $model = Timses::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
