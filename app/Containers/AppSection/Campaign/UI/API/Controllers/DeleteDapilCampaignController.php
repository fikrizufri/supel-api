<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\DeleteDapilCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\DeleteCampaignRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteDapilCampaignController extends ApiController
{
    /**
     * @param DeleteCampaignRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteDapilCampaign(DeleteCampaignRequest $request): JsonResponse
    {
        app(DeleteDapilCampaignAction::class)->run($request);

        return $this->noContent();
    }
}
