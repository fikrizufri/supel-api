<?php

namespace App\Containers\AppSection\Voter\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Containers\AppSection\Voter\Tasks\CreateVoterTask;
use App\Containers\AppSection\Voter\UI\API\Requests\CreateVoterRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateVoterAction extends ParentAction
{
    /**
     * @param CreateVoterRequest $request
     * @return Voter
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateVoterRequest $request): Voter
    {
        $data = $request->sanitizeInput([
            'nkk',
            'nik',
            'name',
            'tempat_lahir',
            'tanggal_lahir',
            'kawin',
            'jenis_kelamin',
            'alamat',
            'rt',
            'rw',
            'difabel',
            'tps',
            'group_id',
            'kode_provinsi',
            'kode_kabupaten',
            'kode_kecamatan',
            'kode_desa',
        ]);

        return app(CreateVoterTask::class)->run($data);
    }
}
