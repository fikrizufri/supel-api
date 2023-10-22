<?php

namespace App\Containers\AppSection\Capres\Tasks;

use App\Containers\AppSection\Capres\Data\Repositories\CapresRepository;
use App\Containers\AppSection\Capres\Models\Capres;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateCapresTask extends ParentTask
{
    public function __construct(
        protected CapresRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Capres
    {
        try {
            return $this->repository->create($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
