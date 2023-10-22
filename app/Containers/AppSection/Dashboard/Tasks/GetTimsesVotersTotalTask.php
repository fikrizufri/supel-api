<?php

namespace App\Containers\AppSection\Dashboard\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Dashboard\Data\Repositories\DashboardRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetTimsesVotersTotalTask extends ParentTask
{
    public function __construct(
        protected DashboardRepository $repository
    ) {
    }

    public function run($sub, $kabupatenId, $dapilId)
    {
        return $this->repository->getTimsesTotalVoters($sub, $kabupatenId, $dapilId);
    }
}
