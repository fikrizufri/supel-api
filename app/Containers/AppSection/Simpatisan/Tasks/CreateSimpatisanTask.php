<?php

namespace App\Containers\AppSection\Simpatisan\Tasks;

use App\Containers\AppSection\Simpatisan\Data\Repositories\SimpatisanRepository;
use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateSimpatisanTask extends ParentTask
{
    public function __construct(
        protected SimpatisanRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Simpatisan
    {
        try {
            return $this->repository->create($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
