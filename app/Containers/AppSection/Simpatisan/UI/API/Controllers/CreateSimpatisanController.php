<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Simpatisan\Actions\CreateSimpatisanAction;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\CreateSimpatisanRequest;
use App\Containers\AppSection\Simpatisan\UI\API\Transformers\SimpatisanTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateSimpatisanController extends ApiController
{
    /**
     * @param CreateSimpatisanRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createSimpatisan(CreateSimpatisanRequest $request): JsonResponse
    {
        $simpatisan = app(CreateSimpatisanAction::class)->run($request);

        return $this->created($this->transform($simpatisan, SimpatisanTransformer::class));
    }
}
