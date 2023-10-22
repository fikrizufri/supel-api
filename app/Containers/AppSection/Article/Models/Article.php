<?php

namespace App\Containers\AppSection\Article\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Article extends ParentModel
{
    protected $table = 'articles';
    protected $fillable = [
        'user_id',
        'campaign_id',
        'title',
        'type',
        'category',
        'tags',
        'article_text',
        'img',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Article';
}
