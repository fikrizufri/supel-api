<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Criterias\SubGroupDapilCriteria;
use App\Containers\AppSection\Campaign\Data\Repositories\SubGroupCampaignRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetSubGroupCampaignsTask extends ParentTask
{
    public function __construct(
        protected SubGroupCampaignRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        if ($request->group){

            if($request->for === 'dapil') {
                $this->repository->pushCriteria(new SubGroupDapilCriteria());
            }
            return $this->repository->findWhere(array('group_campaign_id' => $request->group));
        }
        return $this->repository->all();
    }
}
