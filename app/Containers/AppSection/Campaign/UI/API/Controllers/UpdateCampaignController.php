<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Campaign\Actions\UpdateCampaignAction;
use App\Containers\AppSection\Campaign\Tasks\FindCampaignByIdTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateActiveCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\CampaignTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateCampaignController extends ApiController
{
    /**
     * @param UpdateCampaignRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateCampaign(UpdateCampaignRequest $request): array
    {
        $campaign = app(UpdateCampaignAction::class)->run($request);

        return $this->transform($campaign, CampaignTransformer::class);
    }

    public function updateActiveCampaign(UpdateActiveCampaignRequest $request): array
    {
        $campaign = app(FindCampaignByIdTask::class)->run($request->id);

        $campaign->active = !$campaign->active;

        $campaign->save();

        return $this->transform($campaign, CampaignTransformer::class);
    }

}
