<?php

namespace App\Containers\AppSection\Simpatisan\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Containers\AppSection\Simpatisan\Tasks\UpdateSimpatisanTask;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\UpdateSimpatisanRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;

class UpdateSimpatisanAction extends ParentAction
{

    public function run(UpdateSimpatisanRequest $request): Simpatisan
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

        return app(UpdateSimpatisanTask::class)->run($data, $request->id);
    }
}
