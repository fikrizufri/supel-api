<?php

namespace App\Containers\AppSection\Campaign\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class DapilWilayahCampaignRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
