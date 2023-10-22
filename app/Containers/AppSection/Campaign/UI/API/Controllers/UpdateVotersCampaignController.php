<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\UpdateVotersCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateVotersCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\VotersCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class UpdateVotersCampaignController extends ApiController
{

    public function update(UpdateVotersCampaignRequest $request)
    {
        $voter = app(UpdateVotersCampaignAction::class)->run($request);

        return $this->created($this->transform($voter, VotersCampaignTransformer::class));
    }
}
