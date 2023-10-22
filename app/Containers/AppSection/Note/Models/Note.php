<?php

namespace App\Containers\AppSection\Note\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Note extends ParentModel
{
      protected $table = 'notes';
    protected $fillable = [
        'user_id',
        'note',
        'proses',
        'ket'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];


    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Note';
}
