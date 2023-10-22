<?php

namespace App\Containers\AppSection\Area\Actions;

use App\Containers\AppSection\Area\Tasks\GetAllKelurahanAreasTask;
use App\Containers\AppSection\Area\UI\API\Requests\GetAllAreasRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetAllKelurahanAreasAction extends ParentAction
{
    public function run(GetAllAreasRequest $request): mixed
    {
        return app(GetAllKelurahanAreasTask::class)->run($request);
    }
}
