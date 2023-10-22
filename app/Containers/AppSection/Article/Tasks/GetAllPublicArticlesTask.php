<?php

namespace App\Containers\AppSection\Article\Tasks;


use App\Containers\AppSection\Article\Data\Criterias\CategoryCriteria;
use App\Containers\AppSection\Article\Data\Repositories\ArticleRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetAllPublicArticlesTask extends ParentTask
{
    public function __construct(
        protected ArticleRepository $repository
    ) {
    }

    public function run($request): mixed
    {
        $category = $request->category;
        if($category != null) {
            $this->repository->pushCriteria(new CategoryCriteria($category));
        }
        return $this->addRequestCriteria()->repository->paginate();
    }
}
