<?php

namespace App\Containers\AppSection\Partai\Tasks;

use App\Containers\AppSection\Partai\Data\Repositories\PartaiRepository;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdatePartaiTask extends ParentTask
{
    public function __construct(
        protected PartaiRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Partai
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
