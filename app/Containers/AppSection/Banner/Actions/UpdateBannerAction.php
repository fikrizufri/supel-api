<?php

namespace App\Containers\AppSection\Banner\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Banner\Models\Banner;
use App\Containers\AppSection\Banner\Tasks\FindBannerByIdTask;
use App\Containers\AppSection\Banner\Tasks\UpdateBannerTask;
use App\Containers\AppSection\Banner\Tasks\UploadImageBannerTask;
use App\Containers\AppSection\Banner\UI\API\Requests\UpdateBannerRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Storage;

class UpdateBannerAction extends ParentAction
{
    /**
     * @param UpdateBannerRequest $request
     * @return Banner
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateBannerRequest $request): Banner
    {
        $bannerOld = app(FindBannerByIdTask::class)->run($request->id);

        $data = $request->sanitizeInput([
            'ordering',
        ]);

        if ($bannerOld) {
            if ($request->file('image')) {
                $path = 'storage' . "/" . $bannerOld->image;
                Storage::disk('public_storage')->delete($path);
            }
        }

        $banner = app(UpdateBannerTask::class)->run($data, $request->id);

        if ($imgFile = $request->file('image')) {

            $UploadImg = app(UploadImageBannerTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                $banner = app(UpdateBannerTask::class)->run([
                    'image' => $img
                ], $banner->id);

            }

        }

        return $banner;


    }
}
