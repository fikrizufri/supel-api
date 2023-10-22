<?php

namespace App\Containers\AppSection\Partai\Data\Factories;

use App\Containers\AppSection\Partai\Models\Partai;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class PartaiFactory extends ParentFactory
{
    protected $model = Partai::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
