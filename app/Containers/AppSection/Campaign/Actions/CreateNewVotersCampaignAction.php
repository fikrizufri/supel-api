<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Containers\AppSection\Campaign\Tasks\CreateVotersCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\UploadKTPTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateVotersCampaignRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class CreateNewVotersCampaignAction extends ParentAction
{

    public function run(CreateVotersCampaignRequest $request)
    {
        try {

            Log::info('smape');

            $data = $request->sanitizeInput([
                'campaign_id',
                'partai_id',
                'timses_id',
                'voters_id',
                'status',
                'info',
                'phone',
            ]);

            $timses = Timses::where('id', $data['timses_id'])->select('default_campaign_id')->first();

            $voterC = VotersCampaign::where('voters_id', $data['voters_id'])->where('campaign_id', $data['campaign_id'])->first();

            if ($voterC) {
                throw new NotFoundException('Pendukung sudah dipolling untuk kandidat tersebut.', 422);
            }

            if ($timses) {
                $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('subgroup_campaign_id')->first();
                if ($campaign) {

                    $data['subgroup_campaign_id'] = $campaign->subgroup_campaign_id;
                }
            }

            if ($imgFile = $request->file('ktp')) {


                $UploadImg = app(UploadKTPTask::class)->run($imgFile);

                $voter = Voter::whereId($data['voters_id'])->first();

                if (!empty($UploadImg)) {
                    $img = $UploadImg['image'];
                    $voter->ktp = $img;
                }

                $voter->phone = $data['phone'];
                $voter->save();

            }

            return app(CreateVotersCampaignTask::class)->run($data);

        } catch (Exception $exception) {

            Log::info($exception->getMessage());
            throw new UpdateResourceFailedException($exception->getMessage(), 422);
        }

    }
}
