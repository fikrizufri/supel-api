<?php

namespace App\Containers\AppSection\Article\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Article\Tasks\GetAllPublicArticlesTask;
use App\Containers\AppSection\Article\UI\API\Requests\GetAllArticlesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPublicArticlesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllArticlesRequest $request): mixed
    {
        return app(GetAllPublicArticlesTask::class)->run($request);
    }
}
