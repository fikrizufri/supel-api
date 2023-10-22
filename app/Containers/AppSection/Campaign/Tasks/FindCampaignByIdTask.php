<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\CampaignRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindCampaignByIdTask extends ParentTask
{
    public function __construct(
        protected CampaignRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Campaign
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
