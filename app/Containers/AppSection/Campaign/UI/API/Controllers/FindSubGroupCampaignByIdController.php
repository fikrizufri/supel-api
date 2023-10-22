<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\FindSubGroupCampaignByIdAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindSubGroupCampaignByIdRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\SubGroupCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindSubGroupCampaignByIdController extends ApiController
{

    public function findById(FindSubGroupCampaignByIdRequest $request): array
    {
        $campaign = app(FindSubGroupCampaignByIdAction::class)->run($request);

        return $this->transform($campaign, SubGroupCampaignTransformer::class);
    }
}
