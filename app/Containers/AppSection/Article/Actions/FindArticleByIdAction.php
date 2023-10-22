<?php

namespace App\Containers\AppSection\Article\Actions;

use App\Containers\AppSection\Article\Models\Article;
use App\Containers\AppSection\Article\Tasks\FindArticleByIdTask;
use App\Containers\AppSection\Article\UI\API\Requests\FindArticleByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindArticleByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindArticleByIdRequest $request): Article
    {
        return app(FindArticleByIdTask::class)->run($request->id);
    }
}
