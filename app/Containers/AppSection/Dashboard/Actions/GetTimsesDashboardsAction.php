<?php

namespace App\Containers\AppSection\Dashboard\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Dashboard\Tasks\GetTimsesTotalPollingTask;
use App\Containers\AppSection\Dashboard\Tasks\GetTimsesVotersTotalTask;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetAllDashboardsRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetTimsesDashboardsAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllDashboardsRequest $request)
    {
        $user = $request->user();
        if (!$user) {
            throw new NotFoundException('Data user tidak diketemukan.');
        }

        if($user->hasRole('adminkandidat')) {
            $campaign = Campaign::where('id', $user->campaign_id)->select('id','subgroup_campaign_id', 'kode_dapil',  'kode_kabupaten')->first();
        } else {
            $timses = Timses::whereUserId($user->id)->first();

            if (!$timses) {
                throw new NotFoundException('Data timses tidak diketemukan.');
            }

            $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('id','subgroup_campaign_id', 'kode_dapil',  'kode_kabupaten')->first();

            if (!$campaign) {
                throw new NotFoundException('Data campaign tidak diketemukan.');
            }
        }

        $totalVoters = app(GetTimsesVotersTotalTask::class)->run($campaign->subgroup_campaign_id, $campaign->kode_kabupaten, $campaign->kode_dapil);
        $totalPolling = app(GetTimsesTotalPollingTask::class)->run($campaign->subgroup_campaign_id, $campaign->kode_kabupaten, $campaign->kode_dapil, $timses->id);

        return [
            'total_polling' => $totalPolling,
            'total_voters' => $totalVoters,
        ];
    }
}
