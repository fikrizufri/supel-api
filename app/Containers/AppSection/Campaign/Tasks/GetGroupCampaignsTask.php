<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Data\Repositories\GroupCampaignRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetGroupCampaignsTask extends ParentTask
{
    public function __construct(
        protected GroupCampaignRepository $repository
    ) {
    }


    public function run(): mixed
    {
        return $this->repository->all();
    }
}
