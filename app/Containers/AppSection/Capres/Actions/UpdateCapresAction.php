<?php

namespace App\Containers\AppSection\Capres\Actions;

use App\Containers\AppSection\Capres\Models\Capres;
use App\Containers\AppSection\Capres\Tasks\FindCapresByIdTask;
use App\Containers\AppSection\Capres\Tasks\UpdateCapresTask;
use App\Containers\AppSection\Capres\Tasks\UploadImgCapresTask;
use App\Containers\AppSection\Capres\UI\API\Requests\UpdateCapresRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Storage;

class UpdateCapresAction extends ParentAction
{

    public function run(UpdateCapresRequest $request): Capres
    {
        $capresOld = app(FindCapresByIdTask::class)->run($request->id);

        $data = $request->sanitizeInput([
            'nama_pasangan',
            'description'
        ]);

        if ($capresOld) {
            if ($request->file('image')) {
                $path = 'storage' . "/" . $capresOld->image;
                Storage::disk('public_storage')->delete($path);
            }
        }

        $capres = app(UpdateCapresTask::class)->run($data, $request->id);

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
