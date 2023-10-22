<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\DapilCampaignRepository;
use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateDapilCampaignTask extends ParentTask
{
    public function __construct(
        protected DapilCampaignRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): DapilCampaign
    {
        try {
            return $this->repository->create($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
