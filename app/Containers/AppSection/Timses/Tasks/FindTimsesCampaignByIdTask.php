<?php

namespace App\Containers\AppSection\Timses\Tasks;

use App\Containers\AppSection\Timses\Data\Repositories\TimsesCampaignRepository;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindTimsesCampaignByIdTask extends ParentTask
{
    public function __construct(
        protected TimsesCampaignRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): TimsesCampaign
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
