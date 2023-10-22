<?php

namespace App\Containers\AppSection\Area\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Area\Actions\FindAreaByIdAction;
use App\Containers\AppSection\Area\UI\API\Requests\FindAreaByIdRequest;
use App\Containers\AppSection\Area\UI\API\Transformers\AreaTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindAreaByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findAreaById(FindAreaByIdRequest $request): array
    {
        $area = app(FindAreaByIdAction::class)->run($request);

        return $this->transform($area, AreaTransformer::class);
    }
}
