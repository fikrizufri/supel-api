<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\FindDapilCampaignByIdAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindCampaignByIdRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\DapilCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindDapilCampaignByIdController extends ApiController
{

    public function findDapilCampaignById(FindCampaignByIdRequest $request): array
    {
        $campaign = app(FindDapilCampaignByIdAction::class)->run($request);

        return $this->transform($campaign, DapilCampaignTransformer::class);
    }
}
