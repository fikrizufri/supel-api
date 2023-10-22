<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\subGroupCampaignRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class GetCampaignBySubGroupCampaignByPartaiTask extends ParentTask
{
    public function __construct(
        protected SubGroupCampaignRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
     public function run($request): mixed
    {
        return $this->repository->pileg($request->partai, $request->pileg);
    }
}
