<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\DapilWilayahCampaignRepository;
use App\Containers\AppSection\Campaign\Models\DapilWilayahCampaign;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateDapilWilayahCampaignTask extends ParentTask
{
    public function __construct(
        protected DapilWilayahCampaignRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data) : DapilWilayahCampaign
    {
        try {
            return $this->repository->create($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
