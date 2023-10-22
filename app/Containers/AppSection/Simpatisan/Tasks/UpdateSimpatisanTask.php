<?php

namespace App\Containers\AppSection\Simpatisan\Tasks;

use App\Containers\AppSection\Simpatisan\Data\Repositories\SimpatisanRepository;
use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateSimpatisanTask extends ParentTask
{
    public function __construct(
        protected SimpatisanRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Simpatisan
    {
        try {
            return $this->repository->update($data, $id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
