<?php

namespace App\Containers\AppSection\Simpatisan\Actions;

use App\Containers\AppSection\Simpatisan\Tasks\DeleteSimpatisanTask;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\DeleteSimpatisanRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteSimpatisanAction extends ParentAction
{
    /**
     * @param DeleteSimpatisanRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteSimpatisanRequest $request): int
    {
        return app(DeleteSimpatisanTask::class)->run($request->id);
    }
}
