<?php

namespace App\Containers\AppSection\Voter\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Containers\AppSection\Voter\Events\VotersListedEvent;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllVotersAreaTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }

  
    public function run($request): mixed
    {
        return $this->repository->total($request->total);
    }
}