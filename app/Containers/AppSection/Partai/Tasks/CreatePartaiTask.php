<?php

namespace App\Containers\AppSection\Partai\Tasks;

use App\Containers\AppSection\Partai\Data\Repositories\PartaiRepository;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreatePartaiTask extends ParentTask
{
    public function __construct(
        protected PartaiRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Partai
    {
        try {
            return $this->repository->create($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
