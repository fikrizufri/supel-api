<?php

namespace App\Containers\AppSection\Article\Data\Factories;

use App\Containers\AppSection\Article\Models\Article;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class ArticleFactory extends ParentFactory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
