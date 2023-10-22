<?php

namespace App\Containers\AppSection\Article\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Article\Models\Article;
use App\Containers\AppSection\Article\Tasks\FindArticleByIdTask;
use App\Containers\AppSection\Article\Tasks\UpdateArticleTask;
use App\Containers\AppSection\Article\Tasks\UploadImgArticleTask;
use App\Containers\AppSection\Article\UI\API\Requests\UpdateArticleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateArticleAction extends ParentAction
{
    /**
     * @param UpdateArticleRequest $request
     * @return Article
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateArticleRequest $request): Article
    {
        $articleOld = app(FindArticleByIdTask::class)->run($request->id);

        $data = $request->sanitizeInput([
            'campaign_id',
            'title',
            'type',
            'category',
            'tags',
            'article_text',
        ]);

        if ($articleOld) {
            if ($request->file('img')) {
                $path = 'storage' . "/" . $articleOld->img;
                Storage::disk('public_storage')->delete($path);
            }
        }

        $user = Auth::user();

        $data['user_id'] = $user->id;

        $article = app(UpdateArticleTask::class)->run($data, $request->id);

        if ($imgFile = $request->file('img')) {

            $UploadImg = app(UploadImgArticleTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['img'];

                $article->img = $img;

                $article->save();

            }

        }

        return $article;
    }
}
