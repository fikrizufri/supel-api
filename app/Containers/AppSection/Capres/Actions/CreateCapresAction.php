<?php

namespace App\Containers\AppSection\Capres\Actions;

use App\Containers\AppSection\Capres\Models\Capres;
use App\Containers\AppSection\Capres\Tasks\CreateCapresTask;
use App\Containers\AppSection\Capres\Tasks\UpdateCapresTask;
use App\Containers\AppSection\Capres\Tasks\UploadImgCapresTask;
use App\Containers\AppSection\Capres\UI\API\Requests\CreateCapresRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateCapresAction extends ParentAction
{

    public function run(CreateCapresRequest $request): Capres
    {
        $data = $request->sanitizeInput([
            'nama_pasangan',
            'description'
        ]);


        $capres = app(CreateCapresTask::class)->run($data);

        $capresId = $capres->id;

        if ($imgFile = $request->file('img')) {

            $UploadImg = app(UploadImgCapresTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['img'];

                $capres = app(UpdateCapresTask::class)->run([
                    'img' => $img
                ], $capresId);

            }

        }

        return $capres;
    }
}
