<?php

namespace App\Containers\AppSection\Area\UI\API\Controllers;

use App\Containers\AppSection\Area\Actions\FindByKodeAreasAction;
use App\Containers\AppSection\Area\UI\API\Requests\GetAllAreasRequest;
use App\Ship\Parents\Controllers\ApiController;


class FindByKodeAreasController extends ApiController
{
    public function find(GetAllAreasRequest $request)
    {
        $areas = app(FindByKodeAreasAction::class)->run($request);

        return $this->json($areas);
    }
}
