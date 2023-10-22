<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\CreateDapilWilayahCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateDapilWilayahCampaignRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateDapilWilayahCampaignController extends ApiController
{

    public function createDapil(CreateDapilWilayahCampaignRequest $request): JsonResponse
    {
        $campaign = app(CreateDapilWilayahCampaignAction::class)->run($request);

        return $this->created("Create Dapil Wilayah Success");
    }
}
