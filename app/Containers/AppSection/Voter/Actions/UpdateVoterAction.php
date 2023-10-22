<?php

namespace App\Containers\AppSection\Voter\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Containers\AppSection\Voter\Tasks\UpdateVoterTask;
use App\Containers\AppSection\Voter\UI\API\Requests\UpdateVoterRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateVoterAction extends ParentAction
{
    /**
     * @param UpdateVoterRequest $request
     * @return Voter
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateVoterRequest $request): Voter
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

        return app(UpdateVoterTask::class)->run($data, $request->id);
    }
}
