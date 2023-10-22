<?php

namespace App\Containers\AppSection\Area\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Area extends ParentModel
{
    protected $table = 'wilayah';
    protected $fillable = [
        'kode',
        'nama'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Area';
}
