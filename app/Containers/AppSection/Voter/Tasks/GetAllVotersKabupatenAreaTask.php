<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetAllVotersKabupatenAreaTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }


    public function run(): mixed
    {
        return $this->repository->aggregateKabupaten();
    }
}
