<?php

namespace App\Containers\AppSection\Timses\Actions;

use App\Containers\AppSection\Timses\Tasks\DeleteTimsesTask;
use App\Containers\AppSection\Timses\UI\API\Requests\DeleteTimsesRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteTimsesAction extends ParentAction
{
    /**
     * @param DeleteTimsesRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteTimsesRequest $request): int
    {
        return app(DeleteTimsesTask::class)->run($request->id);
    }
}
