<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\DeleteCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\DeleteCampaignRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteCampaignController extends ApiController
{
    /**
     * @param DeleteCampaignRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteCampaign(DeleteCampaignRequest $request): JsonResponse
    {
        app(DeleteCampaignAction::class)->run($request);

        return $this->noContent();
    }
}
