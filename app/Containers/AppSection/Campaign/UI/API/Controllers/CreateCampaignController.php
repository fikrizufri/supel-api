<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\CreateCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\CampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateCampaignController extends ApiController
{

    public function createCampaign(CreateCampaignRequest $request): JsonResponse
    {
        $campaign = app(CreateCampaignAction::class)->run($request);

        return $this->created($this->transform($campaign, CampaignTransformer::class));
    }
}
