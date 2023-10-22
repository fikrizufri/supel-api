<?php

namespace App\Containers\AppSection\Capres\Actions;

use App\Containers\AppSection\Capres\Models\Capres;
use App\Containers\AppSection\Capres\Tasks\FindCapresByIdTask;
use App\Containers\AppSection\Capres\UI\API\Requests\FindCapresByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindCapresByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindCapresByIdRequest $request): Capres
    {
        return app(FindCapresByIdTask::class)->run($request->id);
    }
}
