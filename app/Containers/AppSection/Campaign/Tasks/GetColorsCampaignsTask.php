<?php

namespace App\Containers\AppSection\Campaign\Tasks;


use App\Containers\AppSection\Campaign\Data\Repositories\CampaignRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetColorsCampaignsTask extends ParentTask
{
    public function __construct(
        protected CampaignRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        $campaignId = $request->get('campaign');
        return $this->repository->getColors($campaignId);

    }
}
