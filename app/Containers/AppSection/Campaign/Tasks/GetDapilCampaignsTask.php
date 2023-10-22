<?php

namespace App\Containers\AppSection\Campaign\Tasks;


use App\Containers\AppSection\Campaign\Data\Repositories\DapilCampaignRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetDapilCampaignsTask extends ParentTask
{
    public function __construct(
        protected DapilCampaignRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        if ($request->subgroup) {
            return $this->repository->findWhere(array('subgroup' => $request->subgroup));
        }

        return $this->repository->paginate();

    }
}
