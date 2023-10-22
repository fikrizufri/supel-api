<?php

namespace App\Containers\AppSection\Campaign\Tasks;


use App\Containers\AppSection\Campaign\Data\Repositories\DapilWilayahCampaignRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetDapilWilayahCampaignsTask extends ParentTask
{
    public function __construct(
        protected DapilWilayahCampaignRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        return $this->repository->findWhere(array('dapil_id' => $request->id));
    }
}
