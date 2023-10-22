<?php

namespace App\Containers\AppSection\Partai\Actions;

use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Partai\Tasks\FindPartaiByIdTask;
use App\Containers\AppSection\Partai\Tasks\UpdatePartaiTask;
use App\Containers\AppSection\Partai\Tasks\UploadSimbolPartaiTask;
use App\Containers\AppSection\Partai\UI\API\Requests\UpdatePartaiRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Storage;

class UpdatePartaiAction extends ParentAction
{

    public function run(UpdatePartaiRequest $request): Partai
    {
        $partaiOld = app(FindPartaiByIdTask::class)->run($request->id);

        $data = $request->sanitizeInput([
            'nomer_urut',
            'name',
            'slogan',
            'alamat',
            'email',
            'warna',
            'is_client'
        ]);

        if ($partaiOld) {
            if ($request->file('simbol')) {
                $path = 'storage' . "/" . $partaiOld->simbol;
                Storage::disk('public_storage')->delete($path);
            }
        }

        $partai =  app(UpdatePartaiTask::class)->run($data, $request->id);

        if ($imgFile = $request->file('simbol')) {

            $UploadImg = app(UploadSimbolPartaiTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['simbol'];

                $partai->simbol = $img;

                $partai->save();

            }

        }

        return $partai;
    }
}
