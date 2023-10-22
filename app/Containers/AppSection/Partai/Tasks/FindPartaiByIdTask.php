<?php

namespace App\Containers\AppSection\Partai\Tasks;

use App\Containers\AppSection\Partai\Data\Repositories\PartaiRepository;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindPartaiByIdTask extends ParentTask
{
    public function __construct(
        protected PartaiRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Partai
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
