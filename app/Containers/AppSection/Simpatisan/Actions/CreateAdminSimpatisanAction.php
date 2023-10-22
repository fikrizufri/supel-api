<?php

namespace App\Containers\AppSection\Simpatisan\Actions;


use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Containers\AppSection\Simpatisan\Tasks\CreateSimpatisanTask;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\CreateAdminSimpatisanRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateAdminSimpatisanAction extends ParentAction
{

    public function run(CreateAdminSimpatisanRequest $request): Simpatisan
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
            'campaign_id',
        ]);

        return app(CreateSimpatisanTask::class)->run($data);
    }
}
