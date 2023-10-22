<?php

namespace App\Containers\AppSection\Campaign\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class PartaiFilterCriteria extends Criteria
{
    protected int $partai;

    public function __construct($partai)
    {
        $this->partai = $partai;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('kode_partai', $this->partai);
    }
}
