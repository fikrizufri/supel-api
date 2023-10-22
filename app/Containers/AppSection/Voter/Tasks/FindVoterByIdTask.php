<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Containers\AppSection\Voter\Events\VoterFoundByIdEvent;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindVoterByIdTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Voter
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
