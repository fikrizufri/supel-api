<?php

namespace App\Containers\AppSection\Area\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Area\Actions\CreateAreaAction;
use App\Containers\AppSection\Area\UI\API\Requests\CreateAreaRequest;
use App\Containers\AppSection\Area\UI\API\Transformers\AreaTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateAreaController extends ApiController
{
    /**
     * @param CreateAreaRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createArea(CreateAreaRequest $request): JsonResponse
    {
        $area = app(CreateAreaAction::class)->run($request);

        return $this->created($this->transform($area, AreaTransformer::class));
    }
}
