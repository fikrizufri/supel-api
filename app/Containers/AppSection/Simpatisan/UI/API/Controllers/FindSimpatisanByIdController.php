<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Simpatisan\Actions\FindSimpatisanByIdAction;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\FindSimpatisanByIdRequest;
use App\Containers\AppSection\Simpatisan\UI\API\Transformers\SimpatisanTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindSimpatisanByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findSimpatisanById(FindSimpatisanByIdRequest $request): array
    {
        $simpatisan = app(FindSimpatisanByIdAction::class)->run($request);

        return $this->transform($simpatisan, SimpatisanTransformer::class);
    }
}
