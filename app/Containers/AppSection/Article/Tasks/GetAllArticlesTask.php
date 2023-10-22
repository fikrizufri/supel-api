<?php

namespace App\Containers\AppSection\Article\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Article\Data\Criterias\CampaignCriteria;
use App\Containers\AppSection\Article\Data\Repositories\ArticleRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllArticlesTask extends ParentTask
{
    public function __construct(
        protected ArticleRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();

        if($user->hasRole('adminkandidat')) {
            $this->repository->pushCriteria(new CampaignCriteria($user->campaign_id));
        }

        return $this->addRequestCriteria()->repository->paginate();
    }
}
