<?php

namespace App\Containers\AppSection\Partai\Actions;

use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Partai\Tasks\FindPartaiByIdTask;
use App\Containers\AppSection\Partai\UI\API\Requests\FindPartaiByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindPartaiByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindPartaiByIdRequest $request): Partai
    {
        return app(FindPartaiByIdTask::class)->run($request->id);
    }
}
