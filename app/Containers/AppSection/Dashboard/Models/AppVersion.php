<?php

namespace App\Containers\AppSection\Dashboard\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class AppVersion extends ParentModel
{
    protected $fillable = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'AppVersion';
}
