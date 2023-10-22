<?php

namespace App\Containers\AppSection\Dashboard\Actions;

use App\Containers\AppSection\Dashboard\Tasks\GetVersionTask;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetVersionRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetVersionAction extends ParentAction
{
    public function run(GetVersionRequest $request)
    {
        return app(GetVersionTask::class)->run();
    }
}
