<?php

namespace App\Containers\AppSection\Banner\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Banner\Actions\GetAllBannersAction;
use App\Containers\AppSection\Banner\UI\API\Requests\GetAllBannersRequest;
use App\Containers\AppSection\Banner\UI\API\Transformers\BannerTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllBannersController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllBanners(GetAllBannersRequest $request): array
    {
        $banners = app(GetAllBannersAction::class)->run($request);

        return $this->transform($banners, BannerTransformer::class);
    }
}
