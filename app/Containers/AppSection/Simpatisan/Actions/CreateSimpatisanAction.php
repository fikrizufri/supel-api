<?php

namespace App\Containers\AppSection\Simpatisan\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Containers\AppSection\Simpatisan\Tasks\CreateSimpatisanTask;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\CreateSimpatisanRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;

class CreateSimpatisanAction extends ParentAction
{
    /**
     * @param CreateSimpatisanRequest $request
     * @return Simpatisan
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateSimpatisanRequest $request): Simpatisan
    {
        $data = $request->sanitizeInput([
            'nik',
            'name',
            'gender',
            'place_of_birth',
            'date_of_birth',
            'address',
            'kode_province',
            'kode_kabupaten',
            'kode_kecamatan',
            'kode_desa',
            'religion',
            'status_perkawinan',
            'pekerjaan',
        ]);

        $user = $request->user();

        if (!$user) {
            throw new NotFoundException('Data user tidak ditemukan.');
        }

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        $campaign = Campaign::whereIdAkun($timses->default_campaign_id)->first();

        if (!$campaign) {
            throw new NotFoundException('Data kandidat tidak ditemukan.');
        }

        $data['date_of_birth'] = Carbon::createFromFormat('m/d/Y', $data['date_of_birth'])->format('Y-m-d');
        $data['campaign_id'] = $campaign->id;

        return app(CreateSimpatisanTask::class)->run($data);
    }
}
