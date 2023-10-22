<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterCampaignRequest;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Log;

class AddTimsesCampaignAction extends ParentAction
{

    public function run(RegisterCampaignRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'campaign_id',
            'timses_id',
            'saksi',
        ]);

        try {

            $campaign = Campaign::whereIdAkun(strtoupper($sanitizedData['campaign_id']))->first();

            if (!$campaign) {
                throw new NotFoundException('Data kandidat tidak ditemukan.');
            }

            $timses = Timses::whereId($sanitizedData['timses_id'])->first();

            if (!$timses) {
                throw new NotFoundException('Data timses tidak ditemukan.');
            }

            $cekData = TimsesCampaign::where('timses_id', $sanitizedData['timses_id'])->where('campaign_id', strtoupper($sanitizedData['campaign_id']))->first();

            if ($cekData) {
                throw new ValidationFailedException('Data kandidat sudah didaftarkan.');
            }

            TimsesCampaign::create([
                'timses_id' => $sanitizedData['timses_id'],
                'campaign_id' => strtoupper($sanitizedData['campaign_id']),
                'saksi' => $sanitizedData['saksi'],
                'status' => 'unapproved',
            ]);

            return $timses;

        } catch (\Exception $exception) {
            throw new ValidationFailedException($exception->getMessage());
        }



    }
}
