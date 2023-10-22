<?php

namespace App\Containers\AppSection\Partai\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Partai\Tasks\CreatePartaiTask;
use App\Containers\AppSection\Partai\Tasks\UpdatePartaiTask;
use App\Containers\AppSection\Partai\Tasks\UploadSimbolPartaiTask;
use App\Containers\AppSection\Partai\UI\API\Requests\CreatePartaiRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreatePartaiAction extends ParentAction
{
    /**
     * @param CreatePartaiRequest $request
     * @return Partai
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreatePartaiRequest $request): Partai
    {
        $data = $request->sanitizeInput([
            'nomer_urut',
            'name',
            'slogan',
            'alamat',
            'email',
            'warna',
            'is_client'
        ]);

        $partai = app(CreatePartaiTask::class)->run($data);

        $partaiId = $partai->id;

        if ($imgFile = $request->file('simbol')) {

            $UploadImg = app(UploadSimbolPartaiTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['simbol'];

                $partai = app(UpdatePartaiTask::class)->run([
                    'simbol' => $img
                ], $partaiId);

            }

        }

        return $partai;
    }
}
