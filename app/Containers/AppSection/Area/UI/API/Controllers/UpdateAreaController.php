<?php

namespace App\Containers\AppSection\Area\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Area\Actions\UpdateAreaAction;
use App\Containers\AppSection\Area\UI\API\Requests\UpdateAreaRequest;
use App\Containers\AppSection\Area\UI\API\Transformers\AreaTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateAreaController extends ApiController
{
    /**
     * @param UpdateAreaRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateArea(UpdateAreaRequest $request): array
    {
        $area = app(UpdateAreaAction::class)->run($request);

        return $this->transform($area, AreaTransformer::class);
    }
}
