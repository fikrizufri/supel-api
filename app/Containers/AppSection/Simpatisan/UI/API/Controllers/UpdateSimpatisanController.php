<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Simpatisan\Actions\UpdateSimpatisanAction;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\UpdateSimpatisanRequest;
use App\Containers\AppSection\Simpatisan\UI\API\Transformers\SimpatisanTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateSimpatisanController extends ApiController
{
    /**
     * @param UpdateSimpatisanRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateSimpatisan(UpdateSimpatisanRequest $request): array
    {
        $simpatisan = app(UpdateSimpatisanAction::class)->run($request);

        return $this->transform($simpatisan, SimpatisanTransformer::class);
    }
}
