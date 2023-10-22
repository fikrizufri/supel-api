<?php

namespace App\Containers\AppSection\Timses\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Timses extends ParentModel
{
    protected $fillable = [
        'campaign_id',
        'user_id',
        'group_id',
        'name',
        'nick_name',
        'phone',
        'nik',
        'id_akun',
        'kode_province',
        'kode_kabupaten',
        'kode_kecamatan',
        'kode_desa',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Timses';
}
