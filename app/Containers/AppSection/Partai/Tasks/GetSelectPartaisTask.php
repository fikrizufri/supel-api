<?php

namespace App\Containers\AppSection\Partai\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Partai\Data\Repositories\PartaiRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetSelectPartaisTask extends ParentTask
{
    public function __construct(
        protected PartaiRepository $repository
    ) {
    }

    /**
     * @param bool $skipPagination
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(bool $skipPagination = false): mixed
    {
        $repository = $this->addRequestCriteria()->repository;

        return $repository->orderBy('nomer_urut', 'asc')->all();
    }
}
