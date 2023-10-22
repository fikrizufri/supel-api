<?php

namespace App\Containers\AppSection\Article\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Article\Actions\CreateArticleAction;
use App\Containers\AppSection\Article\UI\API\Requests\CreateArticleRequest;
use App\Containers\AppSection\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateArticleController extends ApiController
{
    /**
     * @param CreateArticleRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createArticle(CreateArticleRequest $request): JsonResponse
    {
        $article = app(CreateArticleAction::class)->run($request);

        return $this->created($this->transform($article, ArticleTransformer::class));
    }
}
