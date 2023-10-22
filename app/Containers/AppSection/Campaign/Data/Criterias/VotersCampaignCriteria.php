<?php

namespace App\Containers\AppSection\Campaign\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class VotersCampaignCriteria extends Criteria
{
    protected $search;
    protected $sortBy;
    protected $sortType;

    public function __construct($search, $sortBy, $sortType)
    {
        $this->search = $search;
        $this->sortBy = $sortBy;
        $this->sortType = $sortType;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $model = $model->join('campaigns', 'voters_campaign.campaign_id', '=', 'campaigns.id')
            ->join('voters', 'voters_campaign.voters_id', '=', 'voters.id');

        if ($this->search) {
            $model = $model->where('voters.name', 'like', '%' . $this->search . '%')
                ->orWhere('voters.tempat_lahir', 'like', '%' . $this->search . '%');
        }

        return $model->select([
            'voters_campaign.*',
            'campaigns.name as campaign_name',
            'campaigns.id_akun as akun',
            'campaigns.singkatan',
            DB::raw('(SELECT t.kode FROM subgroup_campaigns t WHERE t.id=campaigns.subgroup_campaign_id LIMIT 1) as kode_sub'),
            DB::raw('(SELECT p.name FROM subgroup_campaigns p WHERE p.id=campaigns.subgroup_campaign_id LIMIT 1) as name_sub'),
            'voters.kode_provinsi',
            'voters.kode_kabupaten',
            'voters.kode_kecamatan',
            'voters.kode_desa',
            'voters.alamat',
            'voters.name as voter_name',
            'voters.nkk',
            'voters.nik',
            'voters.tempat_lahir',
            'voters.tanggal_lahir',
            'voters.jenis_kelamin',
            'voters.kawin',
        ])->orderBy('voters.kode_kabupaten', 'desc')->orderBy('voters.kode_kecamatan', 'desc')->orderBy('voters.kode_desa', 'desc');
    }
}
