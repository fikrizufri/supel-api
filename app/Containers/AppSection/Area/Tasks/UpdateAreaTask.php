<?php

namespace App\Containers\AppSection\Area\Tasks;

use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Containers\AppSection\Area\Events\AreaUpdatedEvent;
use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateAreaTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Area
    {
        try {
            $area = $this->repository->update($data, $id);
            AreaUpdatedEvent::dispatch($area);

            return $area;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
