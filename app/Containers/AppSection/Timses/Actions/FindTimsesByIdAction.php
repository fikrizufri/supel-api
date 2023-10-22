<?php

namespace App\Containers\AppSection\Timses\Actions;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Tasks\FindTimsesByIdTask;
use App\Containers\AppSection\Timses\UI\API\Requests\FindTimsesByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindTimsesByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindTimsesByIdRequest $request): Timses
    {
        return app(FindTimsesByIdTask::class)->run($request->id);
    }
}
