<?php

namespace App\Containers\AppSection\Simpatisan\Tasks;

use App\Containers\AppSection\Simpatisan\Data\Repositories\SimpatisanRepository;
use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindSimpatisanByIdTask extends ParentTask
{
    public function __construct(
        protected SimpatisanRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Simpatisan
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
