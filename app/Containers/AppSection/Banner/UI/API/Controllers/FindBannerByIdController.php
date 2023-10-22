<?php

namespace App\Containers\AppSection\Banner\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Banner\Actions\FindBannerByIdAction;
use App\Containers\AppSection\Banner\UI\API\Requests\FindBannerByIdRequest;
use App\Containers\AppSection\Banner\UI\API\Transformers\BannerTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindBannerByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findBannerById(FindBannerByIdRequest $request): array
    {
        $banner = app(FindBannerByIdAction::class)->run($request);

        return $this->transform($banner, BannerTransformer::class);
    }
}
