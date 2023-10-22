<?php

namespace App\Containers\AppSection\Banner\UI\API\Controllers;

use App\Containers\AppSection\Banner\Actions\DeleteBannerAction;
use App\Containers\AppSection\Banner\UI\API\Requests\DeleteBannerRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteBannerController extends ApiController
{
    /**
     * @param DeleteBannerRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteBanner(DeleteBannerRequest $request): JsonResponse
    {
        app(DeleteBannerAction::class)->run($request);

        return $this->noContent();
    }
}
