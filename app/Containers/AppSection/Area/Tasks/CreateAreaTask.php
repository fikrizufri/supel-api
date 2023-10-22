<?php

namespace App\Containers\AppSection\Area\Tasks;

use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Containers\AppSection\Area\Events\AreaCreatedEvent;
use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateAreaTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Area
    {
        try {
            $area = $this->repository->create($data);
            AreaCreatedEvent::dispatch($area);

            return $area;
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
