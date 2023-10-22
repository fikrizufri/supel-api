<?php

namespace App\Containers\AppSection\Capres\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Capres extends ParentModel
{
    protected $table = 'capres';
    protected $fillable = [
        'nama_pasangan',
        'img',
        'description'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Capres';
}
