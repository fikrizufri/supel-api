<?php

namespace App\Containers\AppSection\Simpatisan\Actions;

use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Containers\AppSection\Simpatisan\Tasks\FindSimpatisanByIdTask;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\FindSimpatisanByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindSimpatisanByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindSimpatisanByIdRequest $request): Simpatisan
    {
        return app(FindSimpatisanByIdTask::class)->run($request->id);
    }
}
