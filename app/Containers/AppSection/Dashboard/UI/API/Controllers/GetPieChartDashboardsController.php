<?php

namespace App\Containers\AppSection\Dashboard\UI\API\Controllers;

use App\Containers\AppSection\Dashboard\Actions\GetPieChartDashboardsAction;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetPieChartDashboardsRequest;
use App\Ship\Parents\Controllers\ApiController;

class GetPieChartDashboardsController extends ApiController
{
    public function getPieChart(GetPieChartDashboardsRequest $request)
    {
        $dashboards = app(GetPieChartDashboardsAction::class)->run($request);

        return $this->json($dashboards);
    }
}
