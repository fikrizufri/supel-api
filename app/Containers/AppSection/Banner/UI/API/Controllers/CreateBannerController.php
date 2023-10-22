<?php

namespace App\Containers\AppSection\Banner\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Banner\Actions\CreateBannerAction;
use App\Containers\AppSection\Banner\UI\API\Requests\CreateBannerRequest;
use App\Containers\AppSection\Banner\UI\API\Transformers\BannerTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateBannerController extends ApiController
{
    /**
     * @param CreateBannerRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createBanner(CreateBannerRequest $request): JsonResponse
    {
        $banner = app(CreateBannerAction::class)->run($request);

        return $this->created($this->transform($banner, BannerTransformer::class));
    }
}
