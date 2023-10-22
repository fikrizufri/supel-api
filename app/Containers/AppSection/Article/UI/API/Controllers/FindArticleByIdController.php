<?php

namespace App\Containers\AppSection\Article\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Article\Actions\FindArticleByIdAction;
use App\Containers\AppSection\Article\UI\API\Requests\FindArticleByIdRequest;
use App\Containers\AppSection\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindArticleByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findArticleById(FindArticleByIdRequest $request): array
    {
        $article = app(FindArticleByIdAction::class)->run($request);

        return $this->transform($article, ArticleTransformer::class);
    }
}
