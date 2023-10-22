<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\GetAllCampaignTimsesAction;
use App\Containers\AppSection\Timses\UI\API\Requests\GetAllTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesCampaignListTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCampaignTimsesController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAll(GetAllTimsesRequest $request)
    {
        $timses = app(GetAllCampaignTimsesAction::class)->run($request);

        return $this->transform($timses, TimsesCampaignListTransformer::class);
    }
}
