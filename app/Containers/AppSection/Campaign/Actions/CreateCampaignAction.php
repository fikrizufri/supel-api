<?php

namespace App\Containers\AppSection\Campaign\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Models\GroupCampaign;
use App\Containers\AppSection\Campaign\Models\SubGroupCampaign;
use App\Containers\AppSection\Campaign\Tasks\CreateCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\UpdateCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\UploadImageTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateCampaignRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateCampaignAction extends ParentAction
{
    /**
     * @param CreateCampaignRequest $request
     * @return Campaign
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateCampaignRequest $request): Campaign
    {

        $data = $request->sanitizeInput([
            'group_campaign_id',
            'subgroup_campaign_id',
            'kode_subgroup_campaign',
            'kode_provinsi',
            'kode_kabupaten',
            'kode_dapil',
            'kode_partai',
            'singkatan',
            'slogan',
            'warna',
            'name',
            'date_campaign',
            'campaign',
            'survey',
            'count',
        ]);

        $campaign = app(CreateCampaignTask::class)->run($data);

        if ($imgFile = $request->file('image')) {

            $UploadImg = app(UploadImageTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                $campaign = app(UpdateCampaignTask::class)->run([
                    'image' => $img
                ], $campaign->id);

            }

        }

        $group = GroupCampaign::find($data['group_campaign_id']);
        $subGroup = SubGroupCampaign::find($data['subgroup_campaign_id']);
        $groupName = $group ? $group->name : '';
        $subGroupName = $subGroup ? $subGroup->name : '';
        $kodeSubGroup = $subGroup ? $subGroup->singkatan : '';
        $kodeProvince = $data['kode_provinsi'];
        $kodeKabupaten = $data['kode_kabupaten'];

        $accountId = '';
        if ($groupName === 'Pilkada' && $subGroupName === 'Gubernur') {
            $accountId = $kodeSubGroup . $kodeProvince . $campaign->id;
        }

        if ($groupName === 'Pilkada' && $subGroupName === 'Bupati') {
            $accountId = $kodeSubGroup . $kodeProvince . $kodeKabupaten . $campaign->id;
        }

        if ($groupName === 'Pileg' && $kodeSubGroup === 'DPD') {
            $accountId = $kodeSubGroup . $kodeProvince . $campaign->id;
        }

        if ($groupName === 'Pileg' && in_array($kodeSubGroup, ['DPR', 'DPRA'])) {
            $accountId = $kodeSubGroup . $data['kode_partai'] . $kodeProvince . $data['kode_dapil'] . $campaign->id;
        }

        if ($groupName === 'Pileg' && $kodeSubGroup === 'DPRK') {
            $accountId = $kodeSubGroup . $data['kode_partai'] . $kodeProvince . $kodeKabupaten . $data['kode_dapil'] . $campaign->id;
        }

        if ($groupName === 'Pilpres' && $kodeSubGroup === 'Presiden') {
            $accountId = $kodeSubGroup . $data['kode_partai'] . $kodeProvince . $kodeKabupaten . $data['kode_dapil'] . $campaign->id;
        }


        $kodeAkun = str_replace(".", "", $accountId);

        $campaign->id_akun = $kodeAkun;

        $campaign->active = 1;

        $campaign->save();

        return $campaign;

    }
}
