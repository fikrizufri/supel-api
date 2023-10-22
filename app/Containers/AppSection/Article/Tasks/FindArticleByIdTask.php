<?php

namespace App\Containers\AppSection\Article\Tasks;

use App\Containers\AppSection\Article\Data\Repositories\ArticleRepository;
use App\Containers\AppSection\Article\Models\Article;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindArticleByIdTask extends ParentTask
{
    public function __construct(
        protected ArticleRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Article
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
