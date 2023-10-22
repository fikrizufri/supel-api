<?php

namespace App\Containers\AppSection\Area\Tasks;

use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Containers\AppSection\Area\Events\AreaFoundByIdEvent;
use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use phpDocumentor\Reflection\Types\Collection;

class FindAreaByIdTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id)
    {
        try {
            return $this->repository->findByCode($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
