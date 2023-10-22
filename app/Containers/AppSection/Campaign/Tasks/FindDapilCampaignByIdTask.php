<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\DapilCampaignRepository;
use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindDapilCampaignByIdTask extends ParentTask
{
    public function __construct(
        protected DapilCampaignRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): DapilCampaign
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
