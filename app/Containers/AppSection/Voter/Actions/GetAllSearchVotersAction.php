<?php

namespace App\Containers\AppSection\Voter\Actions;


use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Containers\AppSection\Voter\Tasks\GetAllSearchVotersTask;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetAllSearchVotersAction extends ParentAction
{
    /**
     * @param GetAllVotersRequest $request
     * @return mixed
     */
    public function run(GetAllVotersRequest $request): mixed
    {
        $user = $request->user();
        if (!$user) {
            throw new NotFoundException('Data user tidak diketemukan.');
        }

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak diketemukan.');
        }

        $timsesCampaign = TimsesCampaign::where('timses_id', $timses->id)->where('campaign_id', $timses->default_campaign_id)->first();

        if (!$timsesCampaign) {
            throw new NotFoundException('Anda belum terdaftar sebagai kandidat tersebut.');
        }

        if ($timsesCampaign->status === 'unapproved') {
            throw new NotFoundException('Tunggu admin mengaktifasi akun anda!.');
        }

        $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('subgroup_campaign_id', 'kode_provinsi', 'kode_kabupaten', 'kode_dapil')->first();

        if (!$campaign) {
            throw new NotFoundException('Data campaign tidak diketemukan.');
        }

        return app(GetAllSearchVotersTask::class)->run($request, $campaign);
    }
}
