<?php

namespace App\Containers\AppSection\Partai\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class PartaiRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
    ];
}
