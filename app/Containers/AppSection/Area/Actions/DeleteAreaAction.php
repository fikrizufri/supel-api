<?php

namespace App\Containers\AppSection\Area\Actions;

use App\Containers\AppSection\Area\Tasks\DeleteAreaTask;
use App\Containers\AppSection\Area\UI\API\Requests\DeleteAreaRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteAreaAction extends ParentAction
{
    /**
     * @param DeleteAreaRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteAreaRequest $request): int
    {
        return app(DeleteAreaTask::class)->run($request->id);
    }
}
