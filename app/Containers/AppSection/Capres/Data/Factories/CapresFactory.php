<?php

namespace App\Containers\AppSection\Capres\Data\Factories;

use App\Containers\AppSection\Capres\Models\Capres;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class CapresFactory extends ParentFactory
{
    protected $model = Capres::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
