<?php

namespace App\Containers\AppSection\Article\Actions;

use App\Containers\AppSection\Article\Tasks\DeleteArticleTask;
use App\Containers\AppSection\Article\Tasks\FindArticleByIdTask;
use App\Containers\AppSection\Article\UI\API\Requests\DeleteArticleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Storage;

class DeleteArticleAction extends ParentAction
{
    /**
     * @param DeleteArticleRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteArticleRequest $request): int
    {
        $articleOld = app(FindArticleByIdTask::class)->run($request->id);

        if ($articleOld) {
            $path = 'storage' . "/" . $articleOld->img;

            Storage::disk('public_storage')->delete($path);
        }

        return app(DeleteArticleTask::class)->run($request->id);
    }
}
