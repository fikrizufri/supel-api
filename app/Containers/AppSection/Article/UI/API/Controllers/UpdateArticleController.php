<?php

namespace App\Containers\AppSection\Article\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Article\Actions\UpdateArticleAction;
use App\Containers\AppSection\Article\UI\API\Requests\UpdateArticleRequest;
use App\Containers\AppSection\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateArticleController extends ApiController
{
    /**
     * @param UpdateArticleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateArticle(UpdateArticleRequest $request): array
    {
        $article = app(UpdateArticleAction::class)->run($request);

        return $this->transform($article, ArticleTransformer::class);
    }
}
