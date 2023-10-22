<?php

namespace App\Containers\AppSection\Note\Data\Factories;

use App\Containers\AppSection\Note\Models\Note;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class NoteFactory extends ParentFactory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
