<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\UpdateDapilWilayahCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateDapilWilayahCampaignRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class UpdateDapilWilayahCampaignController extends ApiController
{

    public function updateDapil(UpdateDapilWilayahCampaignRequest $request): JsonResponse
    {
        $campaign = app(UpdateDapilWilayahCampaignAction::class)->run($request);

        return $this->created("Update Dapil Wilayah Success");
    }
}
