<?php

namespace App\Containers\AppSection\Article\UI\API\Controllers;

use App\Containers\AppSection\Article\Actions\DeleteArticleAction;
use App\Containers\AppSection\Article\UI\API\Requests\DeleteArticleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteArticleController extends ApiController
{
    /**
     * @param DeleteArticleRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteArticle(DeleteArticleRequest $request): JsonResponse
    {
        app(DeleteArticleAction::class)->run($request);

        return $this->noContent();
    }
}
