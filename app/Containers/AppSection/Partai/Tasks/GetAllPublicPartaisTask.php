<?php

namespace App\Containers\AppSection\Partai\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Partai\Data\Repositories\PartaiRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPublicPartaisTask extends ParentTask
{
    public function __construct(
        protected PartaiRepository $repository
    ) {
    }


    public function run(): mixed
    {
        return $this->repository->orderBy('nomer_urut', 'asc')->findWhere(array('is_client' => 1));
    }
}
