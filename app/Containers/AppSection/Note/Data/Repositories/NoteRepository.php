<?php

namespace App\Containers\AppSection\Note\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class NoteRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
