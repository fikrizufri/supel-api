<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Campaign\Actions\FindVoterCampaignByIdAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindVoterCampaignByIdRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\FindVoterCampaignTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindVoterCampaignByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function find(FindVoterCampaignByIdRequest $request): array
    {
        $campaign = app(FindVoterCampaignByIdAction::class)->run($request);

        return $this->transform($campaign, FindVoterCampaignTransformer::class);
    }
}
