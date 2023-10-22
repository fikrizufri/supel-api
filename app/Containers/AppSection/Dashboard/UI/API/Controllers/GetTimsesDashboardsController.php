<?php

namespace App\Containers\AppSection\Dashboard\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Dashboard\Actions\GetTimsesDashboardsAction;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetAllDashboardsRequest;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetTimsesDashboardsController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function get(GetAllDashboardsRequest $request)
    {
        $dashboards = app(GetTimsesDashboardsAction::class)->run($request);

        return $this->json($dashboards);
    }
}
