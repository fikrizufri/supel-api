<?php

namespace App\Containers\AppSection\Voter\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class VoterRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];


    public function total($value)
    {
        $query = "SELECT s.id, s.kode_provinsi, (SELECT t.nama FROM wilayah t WHERE s.kode_provinsi=LEFT(t.kode, 2) LIMIT 1) as provinsi, s.kode_kabupaten,(SELECT t.nama FROM wilayah t WHERE s.kode_kabupaten=LEFT(t.kode, 5) LIMIT 1) as kabupaten, s.kode_kecamatan,(SELECT t.nama FROM wilayah t WHERE s.kode_kecamatan=LEFT(t.kode, 8) LIMIT 1) as kecamatan, s.kode_desa, t.nama, count(s.kode_desa) as jumlah_desa FROM voters s INNER JOIN wilayah t ON s.kode_desa = t.kode GROUP BY kode_kecamatan, kode_kabupaten";
        return DB::select($query);
    }

    public function aggregateProvinsi($value)
    {
        $query = "SELECT w.id, w.kode, w.nama FROM wilayah w INNER JOIN voters v ON w.kode = v.kode_provinsi GROUP BY LEFT(w.kode, 2)";
        return DB::select($query);
    }

    public function aggregateKabupaten()
    {
        $query = "SELECT w.id, w.kode, w.nama FROM wilayah w INNER JOIN voters v ON w.kode = v.kode_kabupaten GROUP BY LEFT(w.kode, 5)";
        return DB::select($query);
    }

    public function aggregateKecamatan()
    {
        $query = "SELECT
                    w.id,
                    (SELECT t.kode FROM wilayah t WHERE t.kode=LEFT(w.kode, 5) LIMIT 1) as kode_kabupaten,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(w.kode, 5) LIMIT 1) as kabupaten,
                    w.kode,
                    w.nama
                    FROM wilayah w INNER JOIN voters v ON w.kode = v.kode_kecamatan GROUP BY LEFT(w.kode, 8)";
        return DB::select($query);
    }

    public function aggregateDesa()
    {
        $query = "SELECT
                   w.id,
                   (SELECT t.kode FROM wilayah t WHERE t.kode=LEFT(w.kode, 8) LIMIT 1) as kode_kecamatan,
                   (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(w.kode, 8) LIMIT 1) as kecamatan,
                   w.kode,
                   w.nama FROM wilayah w INNER JOIN voters v ON w.kode = v.kode_desa GROUP BY w.kode ";
        return DB::select($query);
    }
    
}
