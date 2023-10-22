<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\GetAllTimsesAction;
use App\Containers\AppSection\Timses\Actions\GetAllTimsesBlackAction;
use App\Containers\AppSection\Timses\UI\API\Requests\GetAllTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTimsesController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllTimses(GetAllTimsesRequest $request)
    {
        $timses = app(GetAllTimsesAction::class)->run($request);

        return $this->transform($timses, TimsesTransformer::class);
    }

    public function getAllTimsesBlack(GetAllTimsesRequest $request): array
    {
        $timses = app(GetAllTimsesBlackAction::class)->run($request);

        return $this->transform($timses, TimsesTransformer::class);
    }
}
