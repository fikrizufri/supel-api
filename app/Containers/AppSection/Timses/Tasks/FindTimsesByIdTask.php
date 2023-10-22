<?php

namespace App\Containers\AppSection\Timses\Tasks;

use App\Containers\AppSection\Timses\Data\Repositories\TimsesRepository;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindTimsesByIdTask extends ParentTask
{
    public function __construct(
        protected TimsesRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Timses
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
