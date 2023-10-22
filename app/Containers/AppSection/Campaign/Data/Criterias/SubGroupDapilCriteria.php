<?php

namespace App\Containers\AppSection\Campaign\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class SubGroupDapilCriteria extends Criteria
{
  public function apply($model, PrettusRepositoryInterface $repository)
  {
    return $model->where('kode', '!=', 'DPD');
  }
}
