<?php

namespace App\Containers\AppSection\Banner\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Prettus\Repository\Contracts\CacheableInterface;

class BannerRepository extends ParentRepository implements CacheableInterface
{
    protected int $cacheMinutes = 5;

    protected array $cacheOnly = ['all', 'paginate'];
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
