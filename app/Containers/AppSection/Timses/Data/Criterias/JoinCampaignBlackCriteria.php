<?php

namespace App\Containers\AppSection\Timses\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class JoinCampaignBlackCriteria extends Criteria
{
  public function apply($model, PrettusRepositoryInterface $repository)
  {
      $model = $model->join('timses_campaign', 'timses.id', '=', 'timses_campaign.timses_id')->where('timses_campaign.status', 'unapproved');

      return $model->select([
          'timses_campaign.id as timses_campaign_id',
          DB::raw('(SELECT t.name FROM campaigns t WHERE t.id_akun=timses_campaign.campaign_id LIMIT 1) as kandidat'),
          'timses.user_id',
          'timses.default_campaign_id',
          'timses.name',
          'timses.nick_name',
          'timses.phone',
          'timses.nik',
          'timses.id_akun',
          'timses.id_timses_recommend',
          'timses.created_at',
          'timses_campaign.*',
      ]);
  }
}
