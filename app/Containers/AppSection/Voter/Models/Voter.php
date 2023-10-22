<?php

namespace App\Containers\AppSection\Voter\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Voter extends ParentModel
{
    protected $fillable = [
        'data_id',
        'nkk',
        'nik',
        'name',
        'jenis_kelamin',
        'umur',
        'rt',
        'rw',
        'tempat_lahir',
        'tanggal_lahir',
        'difabel',
        'kawin',
        'group_id',
        'tps',
        'kode_provinsi',
        'kode_kabupaten',
        'kode_kecamatan',
        'kode_desa',
        'ktp',
        'phone',
        'alamat',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Voter';
}
