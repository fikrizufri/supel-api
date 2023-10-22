<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Containers\AppSection\Campaign\Tasks\CreateVotersCampaignTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateVotersCampaignRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Log;

class CreateVotersCampaignAction extends ParentAction
{

    public function run(CreateVotersCampaignRequest $request)
    {

        $requestSurvey = $request->get('survey');

        $dataSurvey = json_decode($requestSurvey, true);

        $voterId = $request->get('voter_id');

        $user = $request->user();

        if (!$user) {
            throw new NotFoundException('Data user tidak ditemukan.');
        }

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        $timsesCampaign = TimsesCampaign::where('timses_id', $timses->id)->where('campaign_id', $timses->default_campaign_id)->first();

        if (!$timsesCampaign) {
            throw new NotFoundException('Anda belum terdaftar sebagai kandidat tersebut.');
        }

        if ($timsesCampaign->status === 'unapproved') {
            throw new NotFoundException('Tunggu admin mengaktifasi akun anda!.');
        }

        if (is_array($dataSurvey)) {

            foreach ($dataSurvey as $data) {

                if(!empty($data['campaign_id']) && !empty($data['partai_id'])) {

                    $voterC = VotersCampaign::where('voters_id', $voterId)->where('campaign_id', $data['campaign_id'])->first();

                    if ($voterC) {
                        throw new NotFoundException('Pendukung sudah dipolling untuk kandidat tersebut.');
                    }

                    $dataInsert = [
                        'timses_id' => $timses->id,
                        'partai_id' => $data['partai_id'],
                        'campaign_id' => $data['campaign_id'],
                        'voters_id' => $voterId,
                        'status' => $data['status'],
                        'info' => $data['info']
                    ];

                    app(CreateVotersCampaignTask::class)->run($dataInsert);

                }

                if(!empty($data['campaign_id']) && empty($data['partai_id'])) {

                    $voterC = VotersCampaign::where('voters_id', $voterId)->where('campaign_id', $data['campaign_id'])->first();

                    if ($voterC) {
                        throw new NotFoundException('Pendukung sudah dipolling untuk kandidat tersebut.');
                    }

                    $dataInsert = [
                        'timses_id' => $timses->id,
                        'partai_id' => null,
                        'campaign_id' => $data['campaign_id'],
                        'voters_id' => $voterId,
                        'status' => $data['status'],
                        'info' => $data['info']
                    ];

                    app(CreateVotersCampaignTask::class)->run($dataInsert);

                }

                if(empty($data['campaign_id']) && !empty($data['partai_id'])) {

                    $voter = VotersCampaign::where('voters_id', $voterId)->where('partai_id', $data['partai_id'])->first();

                    if ($voter) {
                        throw new NotFoundException('Pendukung sudah dipolling untuk partai tersebut.');
                    }

                    $dataInsert = [
                        'timses_id' => $timses->id,
                        'partai_id' => $data['partai_id'],
                        'campaign_id' => null,
                        'voters_id' => $voterId,
                        'status' => $data['status'],
                        'info' => $data['info']
                    ];

                    app(CreateVotersCampaignTask::class)->run($dataInsert);

                }

            }

        }

        return true;
    }
}
