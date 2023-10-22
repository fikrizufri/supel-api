<?php

namespace App\Containers\AppSection\Area\Actions;

use App\Containers\AppSection\Area\Models\Area;
use App\Containers\AppSection\Area\Tasks\FindAreaByIdTask;
use App\Containers\AppSection\Area\UI\API\Requests\FindAreaByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindAreaByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindAreaByIdRequest $request): Area
    {
        return app(FindAreaByIdTask::class)->run($request->id);
    }
}
