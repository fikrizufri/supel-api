<?php

namespace App\Containers\AppSection\Article\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Article\Tasks\GetAllArticlesTask;
use App\Containers\AppSection\Article\UI\API\Requests\GetAllArticlesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllArticlesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllArticlesRequest $request): mixed
    {
        return app(GetAllArticlesTask::class)->run($request);
    }
}
