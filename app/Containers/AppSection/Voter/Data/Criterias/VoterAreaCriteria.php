<?php

namespace App\Containers\AppSection\Voter\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class VoterAreaCriteria extends Criteria
{
  public function apply($model, PrettusRepositoryInterface $repository)
  {
    return $model->where('kode_kabupaten','=','kode_kabupaten' AND 'kode_kecamatan','=','kode_kecamatan' AND 'kode_desa','=','kode_desa');
  }
}
