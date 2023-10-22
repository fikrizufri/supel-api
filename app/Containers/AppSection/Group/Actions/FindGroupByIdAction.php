<?php

namespace App\Containers\AppSection\Group\Actions;

use App\Containers\AppSection\Group\Models\Group;
use App\Containers\AppSection\Group\Tasks\FindGroupByIdTask;
use App\Containers\AppSection\Group\UI\API\Requests\FindGroupByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindGroupByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindGroupByIdRequest $request): Group
    {
        return app(FindGroupByIdTask::class)->run($request->id);
    }
}
