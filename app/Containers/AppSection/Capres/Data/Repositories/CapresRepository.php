<?php

namespace App\Containers\AppSection\Capres\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class CapresRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
