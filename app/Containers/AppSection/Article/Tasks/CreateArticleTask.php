<?php

namespace App\Containers\AppSection\Article\Tasks;

use App\Containers\AppSection\Article\Data\Repositories\ArticleRepository;
use App\Containers\AppSection\Article\Models\Article;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateArticleTask extends ParentTask
{
    public function __construct(
        protected ArticleRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Article
    {
     try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
