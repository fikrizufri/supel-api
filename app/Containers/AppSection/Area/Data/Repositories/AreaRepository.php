<?php

namespace App\Containers\AppSection\Area\Data\Repositories;

use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class AreaRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    public function findByCode($value)
    {
        return $this->model->where('kode', $value)->first();
    }

    public function search($value)
    {
        $query = "SELECT
                    s.id,
                    LEFT(s.kode, 2) as kode_provinsi,
                    LEFT(s.kode, 5) as kode_kabupaten,
                    LEFT(s.kode, 8) as kode_kecamatan,
                    s.kode as kode_kelurahan,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(s.kode, 2) LIMIT 1) as provinsi,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(s.kode, 5) LIMIT 1) as kabupaten,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(s.kode, 8) LIMIT 1) as kecamatan,
                    s.nama as kelurahan
                    FROM wilayah s
                    WHERE s.nama LIKE '$value%' AND LENGTH(s.kode) = 13 LIMIT 1000";
        return DB::select($query);
    }

    public function serachById($value)
    {
        return $this->model->whereIn('kode', $value)->get();
    }

    public function province($value)
    {
        $query = "SELECT
                    s.id,
                    s.kode as kode_provinsi,
                    s.nama as province
                    FROM wilayah s
                    WHERE s.nama LIKE '$value%' AND LENGTH(s.kode) = 2 LIMIT 1000";
        return DB::select($query);
    }

    public function kabupaten($province, $value)
    {
        $whereProvince = '';

        if(!is_null($province)) {
            $whereProvince = " AND s.kode LIKE '$province%'";
        }

        $query = "SELECT
                    s.id,
                    s.kode as kode_kabupaten,
                    s.nama as kabupaten
                    FROM wilayah s
                    WHERE s.nama LIKE '$value%' $whereProvince AND LENGTH(s.kode) = 5 LIMIT 1000";
        return DB::select($query);
    }

    public function kecamatan($kabupaten, $value)
    {
        $whereKabupaten = '';

        if(!is_null($kabupaten)) {
            $whereKabupaten = " AND s.kode LIKE '$kabupaten%'";
        }

        $query = "SELECT
                    s.id,
                    LEFT(s.kode, 5) as kode_kabupaten,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(s.kode, 5) LIMIT 1) as kabupaten,
                    s.kode as kode_kecamatan,
                    s.nama as kecamatan
                    FROM wilayah s
                    WHERE s.nama LIKE '$value%' $whereKabupaten AND LENGTH(s.kode) = 8 LIMIT 1000";
        return DB::select($query);
    }

    public function kelurahan($kecamatan, $value)
    {
        $whereKecamatan = '';

        if(!is_null($kecamatan) && $kecamatan != 'null') {
            $whereKecamatan = " AND s.kode LIKE '$kecamatan%'";
        }

        $query = "SELECT
                    s.id,
                    s.kode as kode_kelurahan,
                    s.nama as kelurahan
                    FROM wilayah s
                    WHERE s.nama LIKE '$value%' $whereKecamatan AND LENGTH(s.kode) = 13 LIMIT 1000";
        return DB::select($query);
    }

    public function provinceDapil($provinceId)
    {
        $query = "SELECT
                    s.id,
                    s.kode as kode_provinsi,
                    s.nama as province
                    FROM wilayah s
                    WHERE s.kode = '$provinceId' AND LENGTH(s.kode) = 2 LIMIT 1000";
        return DB::select($query);
    }


    public function kabupatenDapil($subGroup, $kabupatenId, $dapilId)
    {
        $where = " WHERE LENGTH(s.kode) = 5 ";

        if ((int)$subGroup == 2) {
            $where .= " AND s.kode = '$kabupatenId' ";
        }

        if (in_array((int)$subGroup, [3, 5, 6])) {
            $where .= " AND s.kode IN (
                        SELECT
                        kode_kabupaten
                        FROM dapil_wilayah WHERE dapil_id=$dapilId) ";
        }



        $query = "SELECT
                    s.id,
                    s.kode as kode_kabupaten,
                    s.nama as kabupaten
                    FROM wilayah s
                    $where LIMIT 1000";

        return DB::select($query);
    }

    public function kecamatanDapil($subGroup, $kabupatenId, $dapilId, $kabupaten)
    {
        $where = " WHERE LENGTH(s.kode) = 8 ";

        $whereKabupaten = '';

        if(!is_null($kabupaten)) {
            $whereKabupaten = " AND s.kode LIKE '$kabupaten%' ";
        }

        $dapil = DapilCampaign::whereId($dapilId)->first();

        $whereDapil = " AND  s.kode IN (
                            SELECT kode FROM wilayah WHERE kode REGEXP (SELECT
                            GROUP_CONCAT(kode_kabupaten separator '|') as kode
                            FROM dapil_wilayah WHERE dapil_id=$dapilId) AND LENGTH(kode) = 8)";

        if ($dapil) {
            if ($dapil->subgroup == 'DPRK') {
                $whereDapil = " AND s.kode IN (
                                SELECT kode FROM wilayah WHERE kode REGEXP (SELECT
                                GROUP_CONCAT(kode_kecamatan separator '|') as kode
                                FROM dapil_wilayah WHERE dapil_id=$dapilId) AND LENGTH(kode) = 8)";
            }
        }

        if ((int)$subGroup == 2) {
            $where .= " AND s.kode LIKE '$kabupatenId%' ";
        }

        if (in_array((int)$subGroup, [3, 5, 6])) {
            $where .= $whereDapil . $whereKabupaten;
        }

        $query = "SELECT
                    s.id,
                    LEFT(s.kode, 5) as kode_kabupaten,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(s.kode, 5) LIMIT 1) as kabupaten,
                    s.kode as kode_kecamatan,
                    s.nama as kecamatan
                    FROM wilayah s
                    $where LIMIT 1000";

        return DB::select($query);
    }

    public function kelurahanDapil($subGroup, $kabupatenId, $dapilId, $kecamatan)
    {
        $where = " WHERE LENGTH(s.kode) = 13 ";

        $whereKecamatan = '';

        if(!is_null($kecamatan) && $kecamatan != 'null') {
            $whereKecamatan = " AND s.kode LIKE '$kecamatan%' ";
        }

        $dapil = DapilCampaign::whereId($dapilId)->first();

        $whereDapil = " AND s.kode IN (
                            SELECT kode FROM wilayah WHERE kode REGEXP (SELECT
                            GROUP_CONCAT(kode_kabupaten separator '|') as kode
                            FROM dapil_wilayah WHERE dapil_id=$dapilId) AND LENGTH(kode) = 13)";

        if ($dapil) {
            if ($dapil->subgroup == 'DPRK') {
                $whereDapil = " AND s.kode IN (
                                SELECT kode FROM wilayah WHERE kode REGEXP (SELECT
                                GROUP_CONCAT(kode_kecamatan separator '|') as kode
                                FROM dapil_wilayah WHERE dapil_id=$dapilId) AND LENGTH(kode) = 13)";
            }
        }

        if ((int)$subGroup == 2) {
            $where .= " AND s.kode LIKE '$kabupatenId%' $whereKecamatan";
        }

        if (in_array((int)$subGroup, [3, 5, 6])) {
            $where .= $whereDapil . $whereKecamatan;
        }

        $query = "SELECT
                    s.id,
                    s.kode as kode_kelurahan,
                    s.nama as kelurahan
                    FROM wilayah s
                    $where  LIMIT 1000";

        return DB::select($query);
    }
}
