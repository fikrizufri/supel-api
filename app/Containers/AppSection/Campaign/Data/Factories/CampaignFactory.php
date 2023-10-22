<?php

namespace App\Containers\AppSection\Campaign\Data\Factories;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class CampaignFactory extends ParentFactory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
             'name' => $this->faker->name(),
        ];
    }
}
