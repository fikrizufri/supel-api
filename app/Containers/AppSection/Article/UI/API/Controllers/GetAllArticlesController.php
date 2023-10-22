<?php

namespace App\Containers\AppSection\Article\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Article\Actions\GetAllArticlesAction;
use App\Containers\AppSection\Article\UI\API\Requests\GetAllArticlesRequest;
use App\Containers\AppSection\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllArticlesController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllArticles(GetAllArticlesRequest $request): array
    {
        $articles = app(GetAllArticlesAction::class)->run($request);

        return $this->transform($articles, ArticleTransformer::class);
    }
}
