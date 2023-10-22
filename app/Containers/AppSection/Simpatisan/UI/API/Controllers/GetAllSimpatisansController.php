<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Simpatisan\Actions\GetAllSimpatisansAction;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\GetAllSimpatisansRequest;
use App\Containers\AppSection\Simpatisan\UI\API\Transformers\SimpatisanTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllSimpatisansController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllSimpatisans(GetAllSimpatisansRequest $request): array
    {
        $simpatisans = app(GetAllSimpatisansAction::class)->run($request);

        return $this->transform($simpatisans, SimpatisanTransformer::class);
    }
}
