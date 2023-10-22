<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Data\Repositories\VotersCampaignRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTimsesVotersKecamatanTask extends ParentTask
{
    public function __construct(
        protected VotersCampaignRepository $repository
    )
    {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();

        if (!$user) {
            throw new NotFoundException('User tidak ditemukan.');
        }

        $timses = Timses::where('user_id', $user->id)->first();
        $campaign = Campaign::whereIdAkun($timses->default_campaign_id)->select('id', 'subgroup_campaign_id')->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        if (!$campaign) {
            throw new NotFoundException('Belum terdapat di kandidat tersebut.');
        }

        return $this->repository->kecamatan($timses->id, $campaign->subgroup_campaign_id);
    }
}
