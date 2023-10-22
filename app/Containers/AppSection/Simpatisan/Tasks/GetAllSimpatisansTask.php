<?php

namespace App\Containers\AppSection\Simpatisan\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Simpatisan\Data\Criterias\WhereCampaignIdCriteria;
use App\Containers\AppSection\Simpatisan\Data\Criterias\WhereCampaignNullCriteria;
use App\Containers\AppSection\Simpatisan\Data\Repositories\SimpatisanRepository;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllSimpatisansTask extends ParentTask
{
    public function __construct(
        protected SimpatisanRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();

        if($user->hasRole('superadmin') == false) {

            $timses = Timses::where('user_id', $user->id)->select('default_campaign_id')->first();

            if (!$timses) {
                $this->repository->pushCriteria(new WhereCampaignNullCriteria());
                return $this->repository->paginate();
            }

            $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('id')->first();

            if (!$campaign) {
                $this->repository->pushCriteria(new WhereCampaignNullCriteria());
                return $this->repository->paginate();
            }

            $this->repository->pushCriteria(new WhereCampaignIdCriteria($campaign->id));
        }
        return $this->addRequestCriteria()->repository->paginate();
    }
}
