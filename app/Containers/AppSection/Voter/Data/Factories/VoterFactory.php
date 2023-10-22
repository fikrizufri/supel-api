<?php

namespace App\Containers\AppSection\Voter\Data\Factories;

use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class VoterFactory extends ParentFactory
{
    protected $model = Voter::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
