<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\CreateDapilCampaignAction;
use App\Containers\AppSection\Campaign\Actions\CreateVotersCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateDapilCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\DapilCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateDapilCampaignController extends ApiController
{

    public function createDapil(CreateDapilCampaignRequest $request): JsonResponse
    {
        $campaign = app(CreateDapilCampaignAction::class)->run($request);

        return $this->created($this->transform($campaign, DapilCampaignTransformer::class));
    }
}
