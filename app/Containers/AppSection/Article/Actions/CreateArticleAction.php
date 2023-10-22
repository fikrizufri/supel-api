<?php

namespace App\Containers\AppSection\Article\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Article\Models\Article;
use App\Containers\AppSection\Article\Tasks\CreateArticleTask;
use App\Containers\AppSection\Article\Tasks\UpdateArticleTask;
use App\Containers\AppSection\Article\Tasks\UploadImgArticleTask;
use App\Containers\AppSection\Article\UI\API\Requests\CreateArticleRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;

class CreateArticleAction extends ParentAction
{
    /**
     * @param CreateArticleRequest $request
     * @return Article
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateArticleRequest $request): Article
    {
        $data = $request->sanitizeInput([
            'campaign_id',
            'title',
            'type',
            'category',
            'tags',
            'article_text',
        ]);

        $user = Auth::user();

        $data['user_id'] = $user->id;

        $article = app(CreateArticleTask::class)->run($data);

        $articleId = $article->id;

        if ($imgFile = $request->file('img')) {

            $UploadImg = app(UploadImgArticleTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['img'];

                $article = app(UpdateArticleTask::class)->run([
                    'img' => $img
                ], $articleId);

            }

        }

        return $article;
    }
}
