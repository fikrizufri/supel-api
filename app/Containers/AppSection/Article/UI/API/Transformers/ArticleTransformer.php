<?php

namespace App\Containers\AppSection\Article\UI\API\Transformers;

use App\Containers\AppSection\Article\Models\Article;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class ArticleTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Article $article): array
    {




        $response = [
            'object' => $article->getResourceKey(),
            'id' => $article->getHashedKey(),
            'campaign_id' => $article->campaign_id,
            'user_id' => $article->user_id,
            'title' => $article->title,
            'article_text' => $article->article_text,
            'type' => $article->type,
            'category' => $article->category,
            'tags' => $article->tags,
            'img' => $article->img,
        ];

        return $this->ifAdmin([
            'real_id' => $article->id,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'readable_created_at' => $article->created_at->diffForHumans(),
            'readable_updated_at' => $article->updated_at->diffForHumans(),
            // 'deleted_at' => $article->deleted_at,
        ], $response);
    }
}
