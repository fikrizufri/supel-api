<?php

namespace App\Containers\AppSection\Campaign\Models;

use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Support\Facades\DB;

class VotersCampaign extends ParentModel
{
    protected $table = 'voters_campaign';
    protected $fillable = [
        'timses_id',
        'campaign_id',
        'partai_id',
        'voters_id',
        'status',
        'info',
        'subgroup_campaign_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'votercampaign';

    public function group()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }

    public function partai()
    {
        return $this->hasOne(Partai::class, 'id', 'partai_id')->select([
            'id',
            'name',
            'nomer_urut',
        ]);
    }

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id')->select([
            'id',
            'id_akun',
            'subgroup_campaign_id',
            'name',
            DB::raw('(SELECT j.name FROM subgroup_campaigns j WHERE j.id = campaigns.subgroup_campaign_id limit 1) as pemilihan'),
            DB::raw('(SELECT j.name FROM dapil j WHERE j.id = campaigns.kode_dapil limit 1) as dapil'),
        ]);
    }

    public function voter()
    {
        return $this->hasOne(Voter::class, 'id', 'voters_id')->select([
            'id',
            'nik',
            'name',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'umur',
            'jenis_kelamin',
            'tps as kode_tps',
            'ktp',
            'phone',
            DB::raw('(SELECT j.nama FROM wilayah j WHERE j.kode = voters.kode_provinsi limit 1) as nama_provinsi'),
            DB::raw('(SELECT j.nama FROM wilayah j WHERE j.kode = voters.kode_kabupaten limit 1) as nama_kabupaten'),
            DB::raw('(SELECT j.nama FROM wilayah j WHERE j.kode = voters.kode_kecamatan limit 1) as nama_kecamatan'),
            DB::raw('(SELECT j.nama FROM wilayah j WHERE j.kode = voters.kode_desa limit 1) as nama_desa'),
        ]);
    }
}
