<?php

namespace App\Containers\AppSection\Banner\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Banner extends ParentModel
{
    protected $fillable = [
        'image',
        'ordering',
        'active'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Banner';
}
