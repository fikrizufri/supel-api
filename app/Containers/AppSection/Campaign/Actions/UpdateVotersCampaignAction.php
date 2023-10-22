<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Containers\AppSection\Campaign\Tasks\CreateVotersCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\UpdateVotersCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\UploadKTPTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateVotersCampaignRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Log;

class UpdateVotersCampaignAction extends ParentAction
{

    public function run(UpdateVotersCampaignRequest $request)
    {
        try {

            $data = $request->sanitizeInput([
                'campaign_id',
                'partai_id',
                'timses_id',
                'voters_id',
                'status',
                'info',
                'phone',
            ]);

            if (isset($data['campaign_id'])) {
                $voterC = VotersCampaign::where('voters_id', $data['voters_id'])->where('campaign_id', $data['campaign_id'])->first();

                if ($voterC) {
                    throw new NotFoundException('Pendukung sudah dipolling untuk kandidat tersebut.');
                }
            }

            $voter = Voter::whereId($data['voters_id'])->first();

            if ($imgFile = $request->file('ktp')) {

                $UploadImg = app(UploadKTPTask::class)->run($imgFile);

                if (!empty($UploadImg)) {
                    $img = $UploadImg['image'];
                    $voter->ktp = $img;
                }
            }

            $voter->phone = $data['phone'];
            $voter->save();

            unset($data['phone']);

            return app(UpdateVotersCampaignTask::class)->run(array_filter($data), $request->id);

        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new UpdateResourceFailedException($exception->getMessage());
        }

    }
}
