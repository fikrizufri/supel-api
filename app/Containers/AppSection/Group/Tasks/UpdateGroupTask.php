<?php

namespace App\Containers\AppSection\Group\Tasks;

use App\Containers\AppSection\Group\Data\Repositories\GroupRepository;
use App\Containers\AppSection\Group\Events\GroupUpdatedEvent;
use App\Containers\AppSection\Group\Models\Group;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateGroupTask extends ParentTask
{
    public function __construct(
        protected GroupRepository $repository
    ) {
    }

    public function run(array $data, $id)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception->getMessage());
        }
    }
}
