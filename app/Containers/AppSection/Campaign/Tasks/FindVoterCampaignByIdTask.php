<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use App\Containers\AppSection\Campaign\Data\Repositories\VotersCampaignRepository;
use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindVoterCampaignByIdTask extends ParentTask
{
    public function __construct(
        protected VotersCampaignRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): VotersCampaign
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
