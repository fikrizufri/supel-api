<?php

namespace App\Containers\AppSection\Timses\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class TimsesCard extends ParentModel
{
    protected $table = 'timses_card';
    protected $fillable = [
        'timses_id',
        'name',
        'id_card',
        'kode_province',
        'kode_kabupaten',
        'kode_kecamatan',
        'kode_desa',
        'photo',
        'nama_organisasi',
        'slogan_organisasi',
        'logo_organisasi',
        'alamat_organisasi',
        'tanggal_berlaku',
        'email_organisasi',
        'telephone_organisasi',
        'image_generate',
        'warna',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'TimsesCard';
}
