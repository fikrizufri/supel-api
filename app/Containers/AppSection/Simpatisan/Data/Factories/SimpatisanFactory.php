<?php

namespace App\Containers\AppSection\Simpatisan\Data\Factories;

use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class SimpatisanFactory extends ParentFactory
{
    protected $model = Simpatisan::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
