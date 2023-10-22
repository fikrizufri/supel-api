<?php

namespace App\Containers\AppSection\Capres\Tasks;

use App\Containers\AppSection\Capres\Data\Repositories\CapresRepository;
use App\Containers\AppSection\Capres\Models\Capres;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindCapresByIdTask extends ParentTask
{
    public function __construct(
        protected CapresRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Capres
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
