<?php

namespace App\Containers\AppSection\Group\Actions;

use App\Containers\AppSection\Group\Tasks\DeleteGroupTask;
use App\Containers\AppSection\Group\UI\API\Requests\DeleteGroupRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteGroupAction extends ParentAction
{
    /**
     * @param DeleteGroupRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteGroupRequest $request): int
    {
        return app(DeleteGroupTask::class)->run($request->id);
    }
}
