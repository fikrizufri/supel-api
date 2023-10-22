<?php

namespace App\Containers\AppSection\Partai\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Partai extends ParentModel
{
    protected $table = 'partai';
    protected $fillable = [
        'nomer_urut',
        'name',
        'simbol',
        'slogan',
        'alamat',
        'email',
        'warna',
        'is_client'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Partai';
}
