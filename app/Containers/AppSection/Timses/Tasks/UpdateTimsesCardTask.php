<?php

namespace App\Containers\AppSection\Timses\Tasks;

use App\Containers\AppSection\Timses\Data\Repositories\TimsesCardRepository;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateTimsesCardTask extends ParentTask
{
    public function __construct(
        protected TimsesCardRepository $repository
    ) {
    }


    public function run(array $data, $id): TimsesCard
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
