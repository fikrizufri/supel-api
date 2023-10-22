<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\GetCampaignTimsesAction;
use App\Containers\AppSection\Timses\UI\API\Requests\GetAllTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesCampaignSelectTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetCampaignTimsesController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAll(GetAllTimsesRequest $request)
    {
        $timses = app(GetCampaignTimsesAction::class)->run($request);

        return $this->transform($timses, TimsesCampaignSelectTransformer::class);
    }
}
