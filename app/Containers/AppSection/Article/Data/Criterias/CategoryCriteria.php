<?php

namespace App\Containers\AppSection\Article\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class CategoryCriteria extends Criteria
{
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('category', '=', $this->category);
    }
}
