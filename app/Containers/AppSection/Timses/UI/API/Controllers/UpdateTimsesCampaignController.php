<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\UpdateTimsesCampaignAction;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesCampaignRequest;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateTimsesCampaignController extends ApiController
{
    /**
     * @param UpdateTimsesRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateTimses(UpdateTimsesCampaignRequest $request): array
    {
        $timses = app(UpdateTimsesCampaignAction::class)->run($request);

        return $this->transform($timses, TimsesTransformer::class);
    }

}
