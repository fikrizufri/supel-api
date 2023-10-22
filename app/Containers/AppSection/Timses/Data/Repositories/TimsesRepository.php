<?php

namespace App\Containers\AppSection\Timses\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class TimsesRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
    ];
}
