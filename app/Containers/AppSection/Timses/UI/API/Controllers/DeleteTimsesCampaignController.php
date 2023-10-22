<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use App\Containers\AppSection\Timses\Actions\DeleteTimsesCampaignAction;
use App\Containers\AppSection\Timses\UI\API\Requests\DeleteTimsesCampaignRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteTimsesCampaignController extends ApiController
{
    /**
     * @param DeleteTimsesCampaignRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function delete(DeleteTimsesCampaignRequest $request): JsonResponse
    {
        app(DeleteTimsesCampaignAction::class)->run($request);

        return $this->noContent();
    }
}
