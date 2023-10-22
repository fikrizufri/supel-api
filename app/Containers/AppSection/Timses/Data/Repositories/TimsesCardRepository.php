<?php

namespace App\Containers\AppSection\Timses\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class TimsesCardRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
    ];
}
