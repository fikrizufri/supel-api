<?php

namespace App\Containers\AppSection\Banner\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Banner\Actions\UpdateBannerAction;
use App\Containers\AppSection\Banner\UI\API\Requests\UpdateBannerRequest;
use App\Containers\AppSection\Banner\UI\API\Transformers\BannerTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateBannerController extends ApiController
{
    /**
     * @param UpdateBannerRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateBanner(UpdateBannerRequest $request): array
    {
        $banner = app(UpdateBannerAction::class)->run($request);

        return $this->transform($banner, BannerTransformer::class);
    }
}
