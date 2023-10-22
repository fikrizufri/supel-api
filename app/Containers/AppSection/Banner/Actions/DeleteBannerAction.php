<?php

namespace App\Containers\AppSection\Banner\Actions;

use App\Containers\AppSection\Banner\Tasks\DeleteBannerTask;
use App\Containers\AppSection\Banner\Tasks\FindBannerByIdTask;
use App\Containers\AppSection\Banner\UI\API\Requests\DeleteBannerRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Storage;

class DeleteBannerAction extends ParentAction
{
    /**
     * @param DeleteBannerRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteBannerRequest $request): int
    {
        $bannerOld = app(FindBannerByIdTask::class)->run($request->id);

        if ($bannerOld) {
            $path = 'storage' . "/" . $bannerOld->image;
            Storage::disk('public_storage')->delete($path);
        }

        return app(DeleteBannerTask::class)->run($request->id);
    }
}
