<?php

namespace App\Containers\AppSection\Campaign\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class SubGroupFilterCriteria extends Criteria
{
    protected int $subGroup;

    public function __construct($subGroup)
    {
        $this->subGroup = $subGroup;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('subgroup_campaign_id', $this->subGroup);
    }
}
