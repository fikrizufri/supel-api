<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\CreateNewVotersCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateVotersCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\VotersCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class CreateNewVotersCampaignController extends ApiController
{

    public function create(CreateVotersCampaignRequest $request)
    {
        $voter = app(CreateNewVotersCampaignAction::class)->run($request);

        return $this->created($this->transform($voter, VotersCampaignTransformer::class));
    }
}
