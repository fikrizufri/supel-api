<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\VotersCampaignRepository;
use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateVotersCampaignTask extends ParentTask
{
    public function __construct(
        protected VotersCampaignRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): VotersCampaign
    {
        try {
            return $this->repository->create($data);
        } catch (Exception $e) {
            throw new CreateResourceFailedException($e->getMessage());
        }
    }
}
