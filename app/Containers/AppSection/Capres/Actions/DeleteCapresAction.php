<?php

namespace App\Containers\AppSection\Capres\Actions;

use App\Containers\AppSection\Capres\Tasks\DeleteCapresTask;
use App\Containers\AppSection\Capres\UI\API\Requests\DeleteCapresRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteCapresAction extends ParentAction
{
    /**
     * @param DeleteCapresRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteCapresRequest $request): int
    {
        return app(DeleteCapresTask::class)->run($request->id);
    }
}
