<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Campaign\Actions\FindCampaignByIdAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindCampaignByIdRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\CampaignTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindCampaignByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findCampaignById(FindCampaignByIdRequest $request): array
    {
        $campaign = app(FindCampaignByIdAction::class)->run($request);

        return $this->transform($campaign, CampaignTransformer::class);
    }
}
