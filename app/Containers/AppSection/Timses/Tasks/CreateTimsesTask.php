<?php

namespace App\Containers\AppSection\Timses\Tasks;

use App\Containers\AppSection\Timses\Data\Repositories\TimsesRepository;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateTimsesTask extends ParentTask
{
    public function __construct(
        protected TimsesRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Timses
    {
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
