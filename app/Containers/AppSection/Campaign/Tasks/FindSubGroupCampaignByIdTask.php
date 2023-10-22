<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\SubGroupCampaignRepository;
use App\Containers\AppSection\Campaign\Models\SubGroupCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindSubGroupCampaignByIdTask extends ParentTask
{
    public function __construct(
        protected SubGroupCampaignRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): SubGroupCampaign
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
