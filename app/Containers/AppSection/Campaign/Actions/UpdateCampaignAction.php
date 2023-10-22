<?php

namespace App\Containers\AppSection\Campaign\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Article\Tasks\FindArticleByIdTask;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Models\GroupCampaign;
use App\Containers\AppSection\Campaign\Models\SubGroupCampaign;
use App\Containers\AppSection\Campaign\Tasks\FindCampaignByIdTask;
use App\Containers\AppSection\Campaign\Tasks\UpdateCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\UploadImageTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateCampaignRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Storage;

class UpdateCampaignAction extends ParentAction
{
    /**
     * @param UpdateCampaignRequest $request
     * @return Campaign
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateCampaignRequest $request): Campaign
    {
        $campaignOld = app(FindCampaignByIdTask::class)->run($request->id);

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

        if ($campaignOld) {
            if ($request->file('image')) {
                $path = 'storage' . "/" . $campaignOld->image;
                Storage::disk('public_storage')->delete($path);
            }
        }

        $campaign = app(UpdateCampaignTask::class)->run($data, $request->id);

        if ($imgFile = $request->file('image')) {

            $UploadImg = app(UploadImageTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                $campaign->image = $img;

                $campaign->save();

            }

        }

        $group = GroupCampaign::find($data['group_campaign_id']);
        $subGroup = SubGroupCampaign::find($data['subgroup_campaign_id']);
        $groupName = $group ? $group->name : '';
        $subGroupName = $subGroup ? $subGroup->name : '';
        $kodeSubGroup = $subGroup ? $subGroup->kode : '';
        $kodeProvince = $data['kode_provinsi'];
        $kodeKabupaten = $data['kode_kabupaten'];

        $accountId = '';
        if($groupName === 'Pilkada' && $subGroupName === 'Gubernur') {
            $accountId = $kodeSubGroup . $kodeProvince . $campaign->id;
        }

        if($groupName === 'Pilkada' && $subGroupName === 'Bupati') {
            $accountId = $kodeSubGroup . $kodeProvince . $kodeKabupaten . $campaign->id;
        }

        if($groupName === 'Pileg' && $kodeSubGroup === 'DPD') {
            $accountId = $kodeSubGroup . $kodeProvince . $campaign->id;
        }

        if($groupName === 'Pileg' && in_array($kodeSubGroup, ['DPR', 'DPRA'])) {
            $accountId = $kodeSubGroup . $data['kode_partai'] . $kodeProvince . $data['kode_dapil'] . $campaign->id;
        }

        if($groupName === 'Pileg' && $kodeSubGroup === 'DPRK') {
            $accountId = $kodeSubGroup . $data['kode_partai'] . $kodeProvince . $kodeKabupaten . $data['kode_dapil'] . $campaign->id;
        }

        $kodeAkun = str_replace(".", "", $accountId);

        $campaign->id_akun = $kodeAkun;

        $campaign->campaign = $request->campaign;

        $campaign->survey = $request->survey;

        $campaign->count = $request->count;

        $campaign->save();

        return $campaign;
    }
}
