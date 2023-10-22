<?php

namespace App\Containers\AppSection\Banner\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Banner\Models\Banner;
use App\Containers\AppSection\Banner\Tasks\CreateBannerTask;
use App\Containers\AppSection\Banner\Tasks\UpdateBannerTask;
use App\Containers\AppSection\Banner\Tasks\UploadImageBannerTask;
use App\Containers\AppSection\Banner\UI\API\Requests\CreateBannerRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateBannerAction extends ParentAction
{
    /**
     * @param CreateBannerRequest $request
     * @return Banner
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateBannerRequest $request): Banner
    {
        $data = $request->sanitizeInput([
            'ordering',
        ]);

        $banner = app(CreateBannerTask::class)->run($data);

        $bannerId = $banner->id;

        if ($imgFile = $request->file('image')) {

            $UploadImg = app(UploadImageBannerTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                $banner = app(UpdateBannerTask::class)->run([
                    'image' => $img
                ], $bannerId);

            }

        }

        return $banner;
    }
}
