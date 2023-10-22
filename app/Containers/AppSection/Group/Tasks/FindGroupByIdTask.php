<?php

namespace App\Containers\AppSection\Group\Tasks;

use App\Containers\AppSection\Group\Data\Repositories\GroupRepository;
use App\Containers\AppSection\Group\Events\GroupFoundByIdEvent;
use App\Containers\AppSection\Group\Models\Group;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindGroupByIdTask extends ParentTask
{
    public function __construct(
        protected GroupRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Group
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
