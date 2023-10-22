<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Containers\AppSection\Voter\Data\Criterias\SelectCriteria;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetAllVotersTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }


    public function run($request): mixed
    {

        return $this->repository->pushCriteria(new SelectCriteria($request))->paginate();
    }
}