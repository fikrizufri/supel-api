<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Containers\AppSection\Voter\Events\VoterCreatedEvent;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateVoterTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Voter
    {
        try {
            $voter = $this->repository->create($data);
            return $voter;
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
