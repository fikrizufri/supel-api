<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class AllVotersCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(VotersCampaign $votersCampaign): array
    {
        return [
            'object' => 'voterscampaign',
            'id' => $votersCampaign->id,
            'campaign_id' => $votersCampaign->campaign_id,
            'timses_id' => $votersCampaign->timses_id,
            'timses_name' => $votersCampaign->timses,
            'voters_id' => $votersCampaign->voters_id,
            'status' => $votersCampaign->status,
            'campaign_name' => $votersCampaign->campaign_name,
            'id_akun' => $votersCampaign->akun,
            'singkatan' => $votersCampaign->singkatan,
            'kode_provinsi' => $votersCampaign->kode_provinsi,
            'kode_kabupaten' => $votersCampaign->kode_kabupaten,
            'kode_kecamatan' => $votersCampaign->kode_kecamatan,
            'kode_desa' => $votersCampaign->kode_desa,
            'nama_provinsi' => $votersCampaign->kode_provinsi != null ? get_nama_wilayah($votersCampaign->kode_provinsi) : null,
            'nama_kabupaten' => $votersCampaign->kode_kabupaten != null ? get_nama_wilayah($votersCampaign->kode_kabupaten) : null,
            'nama_kecamatan' => $votersCampaign->kode_kecamatan != null ? get_nama_wilayah($votersCampaign->kode_kecamatan) : null,
            'nama_desa' => $votersCampaign->kode_desa != null ? get_nama_wilayah($votersCampaign->kode_desa) : null,
            'alamat' => $votersCampaign->alamat,
            'voter_name' => $votersCampaign->voter_name,
            'kode_sub' => $votersCampaign->kode_sub,
            'name_sub' => $votersCampaign->name_sub,
            'nkk' => $votersCampaign->nkk,
            'nik' => $votersCampaign->nik,
            'umur' => $votersCampaign->umur,
            'tempat_lahir' => $votersCampaign->tempat_lahir,
            'tanggal_lahir' => $votersCampaign->tanggal_lahir,
            'jenis_kelamin' => $votersCampaign->jenis_kelamin,
            'kawin' => $votersCampaign->kawin,
            'tps' => $votersCampaign->tps,
            'ktp' => $votersCampaign->ktp,
            'phone' => $votersCampaign->phone,
            'created_at' => $votersCampaign->created_at,
            'updated_at' => $votersCampaign->updated_at,
            'readable_created_at' => $votersCampaign->created_at->diffForHumans(),
            'readable_updated_at' => $votersCampaign->updated_at->diffForHumans(),
        ];
    }
}
