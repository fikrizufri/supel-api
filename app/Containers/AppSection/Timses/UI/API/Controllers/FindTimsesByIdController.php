<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\FindTimsesByIdAction;
use App\Containers\AppSection\Timses\UI\API\Requests\FindTimsesByIdRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindTimsesByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findTimsesById(FindTimsesByIdRequest $request): array
    {
        $timses = app(FindTimsesByIdAction::class)->run($request);

        return $this->transform($timses, TimsesTransformer::class);
    }
}
