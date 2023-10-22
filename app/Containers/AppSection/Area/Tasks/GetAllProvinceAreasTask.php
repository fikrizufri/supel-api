<?php

namespace App\Containers\AppSection\Area\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Containers\AppSection\Area\Events\AreasListedEvent;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllProvinceAreasTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        return $this->repository->province($request->search);
    }
}
