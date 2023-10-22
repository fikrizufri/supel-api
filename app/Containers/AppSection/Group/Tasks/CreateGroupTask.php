<?php

namespace App\Containers\AppSection\Group\Tasks;

use App\Containers\AppSection\Group\Data\Repositories\GroupRepository;
use App\Containers\AppSection\Group\Events\GroupCreatedEvent;
use App\Containers\AppSection\Group\Models\Group;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateGroupTask extends ParentTask
{
    public function __construct(
        protected GroupRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Group
    {
        try {
            $group = $this->repository->create($data);
            return $group;
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
