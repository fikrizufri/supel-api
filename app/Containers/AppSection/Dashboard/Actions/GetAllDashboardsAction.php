<?php

namespace App\Containers\AppSection\Dashboard\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Dashboard\Tasks\GetAllDashboardsStatusChartTask;
use App\Containers\AppSection\Dashboard\Tasks\GetAllDashboardsStatusMungkinTask;
use App\Containers\AppSection\Dashboard\Tasks\GetAllDashboardsStatusPastiTask;
use App\Containers\AppSection\Dashboard\Tasks\GetAllDashboardsStatusTidakTask;
use App\Containers\AppSection\Dashboard\Tasks\GetAllDashboardsTask;
use App\Containers\AppSection\Dashboard\Tasks\GetDashboardsDateCampaignTask;
use App\Containers\AppSection\Dashboard\Tasks\GetDashboardsTotalTask;
use App\Containers\AppSection\Dashboard\Tasks\GetDashboardsTotalPollingTask;
use App\Containers\AppSection\Dashboard\Tasks\GetDashboardsVotersTotalTask;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetAllDashboardsRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllDashboardsAction extends ParentAction
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

        if ($user->hasRole('adminkandidat')) {
            $campaign = Campaign::where('id', $user->campaign_id)->select('id', 'subgroup_campaign_id', 'kode_dapil', 'kode_kabupaten')->first();
        } else {
            $timses = Timses::whereUserId($user->id)->first();

            if (!$timses) {
                throw new NotFoundException('Data timses tidak diketemukan.');
            }

            $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('id', 'subgroup_campaign_id', 'kode_dapil', 'kode_kabupaten')->first();

            if (!$campaign) {
                throw new NotFoundException('Data campaign tidak diketemukan.');
            }
        }

        $total = app(GetDashboardsTotalTask::class)->run($campaign->id);
        $totalVoters = app(GetDashboardsVotersTotalTask::class)->run($campaign->subgroup_campaign_id, $campaign->kode_kabupaten, $campaign->kode_dapil);
        $totalPolling = app(GetDashboardsTotalPollingTask::class)->run($campaign->subgroup_campaign_id, $campaign->kode_kabupaten, $campaign->kode_dapil);
        $statusPasti = app(GetAllDashboardsStatusPastiTask::class)->run($campaign->id);
        $statusMungkin = app(GetAllDashboardsStatusMungkinTask::class)->run($campaign->id);
        $statusTidak = app(GetAllDashboardsStatusTidakTask::class)->run($campaign->id);

        return [
            'total' => $total,
            'total_polling' => $totalPolling,
            'total_voters' => $totalVoters,
            'status' => app(GetAllDashboardsTask::class)->run($campaign->id),
            'status_pasti' => $statusPasti,
            'status_mungkin' => $statusMungkin,
            'status_tidak' => $statusTidak,
            'status_chart' => app(GetAllDashboardsStatusChartTask::class)->run($campaign->subgroup_campaign_id, $campaign->kode_dapil, $campaign->kode_kabupaten),
            'date' => app(GetDashboardsDateCampaignTask::class)->run($campaign->id),
            'percentage' => round((($total / $totalVoters) * 100), 2) . '%',
        ];
    }
}