<?php

namespace App\Containers\AppSection\Partai\Actions;

use App\Containers\AppSection\Partai\Tasks\DeletePartaiTask;
use App\Containers\AppSection\Partai\UI\API\Requests\DeletePartaiRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeletePartaiAction extends ParentAction
{
    /**
     * @param DeletePartaiRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeletePartaiRequest $request): int
    {
        return app(DeletePartaiTask::class)->run($request->id);
    }
}
