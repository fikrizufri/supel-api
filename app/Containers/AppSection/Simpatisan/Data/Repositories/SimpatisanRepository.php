<?php

namespace App\Containers\AppSection\Simpatisan\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class SimpatisanRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
    ];
}
