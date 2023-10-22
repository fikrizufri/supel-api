<?php

namespace App\Containers\AppSection\Simpatisan\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Simpatisan extends ParentModel
{
    protected $table = 'simpatisan';

    protected $fillable = [
        'nik',
        'campaign_id',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
        'kode_province',
        'kode_kabupaten',
        'kode_kecamatan',
        'kode_desa',
        'religion',
        'status_perkawinan',
        'pekerjaan',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Simpatisan';
}
