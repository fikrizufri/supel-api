<?php

namespace App\Containers\AppSection\Timses\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class JoinCampaignCriteria extends Criteria
{
  public function apply($model, PrettusRepositoryInterface $repository)
  {
      return  $model->join('timses_campaign', 'timses.id', '=', 'timses_campaign.timses_id')
          ->select([
              DB::raw('(SELECT t.name FROM campaigns t WHERE t.id_akun=timses_campaign.campaign_id LIMIT 1) as kandidat'),
              'timses.id',
              'timses.user_id',
              'timses.default_campaign_id',
              'timses.name',
              'timses.nick_name',
              'timses.phone',
              'timses.nik',
              'timses.id_akun',
              'timses.id_timses_recommend',
              'timses.created_at',
              'timses_campaign.status',
              'timses_campaign.saksi',
              'timses_campaign.id as timses_campaign_id',
          ])->orderBy('timses.id', 'asc');
  }
}
