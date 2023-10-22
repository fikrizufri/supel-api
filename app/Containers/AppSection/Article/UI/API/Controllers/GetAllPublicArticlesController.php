<?php

namespace App\Containers\AppSection\Article\UI\API\Controllers;


use App\Containers\AppSection\Article\Actions\GetAllPublicArticlesAction;
use App\Containers\AppSection\Article\UI\API\Requests\GetAllArticlesRequest;
use App\Containers\AppSection\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllPublicArticlesController extends ApiController
{

    public function getAllArticles(GetAllArticlesRequest $request): array
    {
        $articles = app(GetAllPublicArticlesAction::class)->run($request);

        return $this->transform($articles, ArticleTransformer::class);
    }
}
