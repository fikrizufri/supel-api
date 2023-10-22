<?php

namespace App\Containers\AppSection\Dashboard\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Dashboard\Actions\GetAllDashboardsAction;
use App\Containers\AppSection\Dashboard\Actions\GetPerhitunganDashboardsAction;
use App\Containers\AppSection\Dashboard\Actions\GetPetaSuaraDashboardsAction;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetAllDashboardsRequest;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllDashboardsController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllDashboards(GetAllDashboardsRequest $request)
    {
        $dashboards = app(GetAllDashboardsAction::class)->run($request);

        return $this->json($dashboards);
    }

    public function getPetaSuara(GetAllDashboardsRequest $request)
    {
        $dashboards = app(GetPetaSuaraDashboardsAction::class)->run($request);

        return $this->json(array('data' => $dashboards));
    }

    public function getPerhitungan(GetAllDashboardsRequest $request)
    {
        $dashboards = app(GetPerhitunganDashboardsAction::class)->run($request);

        return $this->json(array('data' => $dashboards));
    }
}
