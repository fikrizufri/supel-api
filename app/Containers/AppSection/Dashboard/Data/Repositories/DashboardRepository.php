<?php

namespace App\Containers\AppSection\Dashboard\Data\Repositories;

use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardRepository extends ParentRepository
{
    protected $fieldSearchable = [

    ];
    public function getTotal($campaignId)
    {
        $raw = "SELECT
                count(a.campaign_id) as total
                FROM voters_campaign a
                WHERE a.campaign_id=$campaignId";
        $data = DB::select($raw);
        return $data[0]->total;
    }

    public function getAllStatus($campaignId)
    {
        $raw = "SELECT
                a.status,
                count(a.campaign_id) as count
                FROM voters_campaign a
                WHERE a.campaign_id=$campaignId
                GROUP BY a.status";
        return DB::select($raw);
    }

    public function getAllStatusPasti($campaignId)
    {
        $raw = "SELECT
                a.status,
                count(a.campaign_id) as total
                FROM voters_campaign a
                WHERE a.status = 'Pasti dipilih' AND a.campaign_id=$campaignId";
        $data = DB::select($raw);
        return $data[0]->total;
    }

    public function getAllStatusMungkin($campaignId)
    {
        $raw = "SELECT
                a.status,
                count(a.campaign_id) as total
                FROM voters_campaign a
                WHERE a.status = 'Mungkin dipilih' AND a.campaign_id=$campaignId";
        $data = DB::select($raw);
        return $data[0]->total;
    }

    public function getAllStatusTidak($campaignId)
    {
        $raw = "SELECT
                a.status,
                count(a.campaign_id) as total
                FROM voters_campaign a
                WHERE a.status = 'Tidak Yakin' AND a.campaign_id=$campaignId";
        $data = DB::select($raw);
        return $data[0]->total;
    }

    public function getAllStatusChart($subGroupCampaign, $dapil, $kabupaten)
    {
        $whereDapil = "";

        if ((int) $subGroupCampaign == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if (in_array((int) $subGroupCampaign, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if ((int) $subGroupCampaign == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupaten' ";
        }

        $raw = "SELECT
                 (SELECT j.warna FROM campaigns j WHERE id=a.campaign_id LIMIT 1) as warna,
                 (SELECT j.name FROM campaigns j WHERE id=a.campaign_id LIMIT 1) as name,
                  count(a.id) as total
                from voters_campaign a
                WHERE a.voters_id IN (
                    SELECT
                        c.id
                        FROM voters c $whereDapil
                ) AND a.subgroup_campaign_id=$subGroupCampaign GROUP BY a.campaign_id, a.partai_id ORDER BY total DESC";
        $data = DB::select($raw);

        $resp = array();
        $colors = array();
        $resp[] = ["Kandidat", "Dukungan"];
        if (!empty($data)) {
            foreach ($data as $object) {
                $resp[] = [$object->name, (int) $object->total];
                $colors[] = $object->warna;
            }
        }

        return [
            'data' => $resp,
            'colors' => $colors,
        ];
    }

    public function getDateCampaign($campaignId)
    {
        $raw = "SELECT DATEDIFF(date_campaign, NOW()) as total FROM campaigns WHERE id=$campaignId";
        $data = DB::select($raw);
        return $data[0]->total;
    }

    public function getPieChart($sub, $provinceId, $kabupatenId, $dapilId, $request, $timsesId)
    {
        $whereDapil = "";

        if ((int) $sub == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapilId)";
        }

        if (in_array((int) $sub, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapilId)";
        }

        if ((int) $sub == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupatenId' ";
        }

        $dataVoters = DB::select(" SELECT
                    count(c.id) as total
                    FROM voters c $whereDapil");

        $totalVoters = $dataVoters[0]->total;

        $whereArea = [];

        if ($prov = $provinceId) {
            array_push($whereArea, "c.kode_provinsi='$prov'");
        }

        if ($kab = $request->get('kode_kabupaten')) {
            array_push($whereArea, "c.kode_kabupaten='$kab'");
        }

        if ($kec = $request->get('kode_kecamatan')) {
            array_push($whereArea, "c.kode_kecamatan='$kec'");
        }

        if ($desa = $request->get('kode_desa')) {
            array_push($whereArea, "c.kode_desa='$desa'");
        }

        $whereAreaString = "";

        if (!empty($whereArea)) {
            $whereAreaString = " AND " . join(" AND ", $whereArea);
        }

        $raw = "SELECT
                    count(a.id) as total,
                    (SELECT j.name FROM campaigns j WHERE id=a.campaign_id LIMIT 1) as name,
                    '#ffddb0' as warna,
                    (SELECT name FROM partai WHERE id=a.partai_id LIMIT 1) as partai,
                    (SELECT name FROM subgroup_campaigns WHERE id=a.subgroup_campaign_id LIMIT 1) as campaign
                FROM voters_campaign a
                WHERE a.voters_id IN (
                    SELECT
                    c.id
                    FROM voters c $whereDapil $whereAreaString
                ) AND a.subgroup_campaign_id=$sub AND a.timses_id = $timsesId AND a.status = 'Pasti dipilih' GROUP BY a.campaign_id ORDER BY total DESC";

        $data = DB::select($raw);

        $colorsList = [
            '#264c99',
            '#a52a0d',
            '#bf7200',
            '#0c7012',
            '#720072',
            '#007294',
            '#b72153',
            '#4c7f00',
            '#8a2222',
            '#244a6f',
            '#723372',
            '#197f72',
            '#7f7f0c',
            '#4c2699',
            '#ac5600',
            '#680505',
            '#4b0c4d',
            '#256d49',
            '#3f577c',
            '#2c2e81',
            '#895619',
            '#10a017',
            '#8a0e62',
            '#d30b79',
            '#754227',
            '#7e930e',
            '#1f5969',
            '#4c6914',
            '#8e7b0e',
            '#084219',
            '#57270c'
        ];

        $resp = array();
        $colors = array();
        $resp[] = ["Kandidat", "Pemilih"];
        $totalPemilih = 0;
        if (!empty($data)) {
            foreach ($data as $key => $object) {
                $totalPemilih += $object->total;
                $resp[] = [$object->name, (int) $object->total];
                $colors[] = $colorsList[$key];
            }
        }


        $dataPemilih = array();
        if (!empty($data)) {
            foreach ($data as $key => $pemilih) {
                $pemilih->percentage = round(($pemilih->total / $totalPemilih), 1);
                $pemilih->string_percentage = number_format(($pemilih->total / $totalPemilih) * 100, 2) . '%';
                $pemilih->warna = $colorsList[$key];
                array_push($dataPemilih, $pemilih);
            }

            $pemilihTotal = new \stdClass();
            $pemilihTotal->total = $totalVoters - $totalPemilih;
            $pemilihTotal->name = "Belum memilih";
            $pemilihTotal->warna = "#cccccc";
            $pemilihTotal->partai = null;
            $pemilihTotal->campaign = $data[0]->campaign;
            $pemilihTotal->percentage = round((($totalVoters - $totalPemilih) / $totalVoters), 1);
            $pemilihTotal->string_percentage = round(((($totalVoters - $totalPemilih) / $totalVoters) * 100), 2) . '%';

            array_push($dataPemilih, $pemilihTotal);

        }

        return [
            'data' => empty($data) ? null : $resp,
            'colors' => $colors,
            'totalPemilih' => $totalVoters,
            'list' => $dataPemilih,
        ];
    }

    public function getPetaSuara($subGroupCampaign, $dapil, $kabupaten)
    {

        $whereDapil = "";

        if ((int) $subGroupCampaign == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if (in_array((int) $subGroupCampaign, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if ((int) $subGroupCampaign == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupaten' ";
        }

        $raw = "SELECT
                 (SELECT j.nomor_urut FROM campaigns j WHERE id=a.campaign_id LIMIT 1) as campaign_id,
                 (SELECT j.id_akun FROM campaigns j WHERE id=a.campaign_id LIMIT 1) as id_akun,
                 (SELECT j.name FROM campaigns j WHERE id=a.campaign_id LIMIT 1) as name,
                 a.subgroup_campaign_id,
                 a.partai_id,
                 (SELECT name FROM subgroup_campaigns WHERE id=a.subgroup_campaign_id LIMIT 1) as pemilihan,
                 (SELECT name FROM partai WHERE id=a.partai_id LIMIT 1) as nama_partai,
                 count(a.id) as jumlah_suara
                from voters_campaign a
                WHERE a.voters_id IN (
                    SELECT
                        c.id
                        FROM voters c $whereDapil
                ) AND a.subgroup_campaign_id=$subGroupCampaign GROUP BY a.campaign_id, a.partai_id ORDER BY jumlah_suara DESC";
        return DB::select($raw);
    }

    public function getPerhitungan($subGroupCampaign, $dapil, $kabupaten)
    {

        $whereDapil = "";
        $whereDapilList = '';
        $whereDapilKandidat = '';

        if (in_array((int) $subGroupCampaign, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if ((int) $subGroupCampaign == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupaten' ";
        }


        if ($dapil != null) {
            if ((int) $subGroupCampaign == 6) {
                $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
            }
            if (in_array((int) $subGroupCampaign, [2, 5, 6])) {
                $whereDapilList = " and b.kode_dapil=" . $dapil . " ";
                $whereDapilKandidat = ' and kode_dapil=' . $dapil;
            }
        }

        $selectKandidat = DB::select('SELECT CONCAT("SUM( IF(a.campaign_id =", id, ", 1, 0) ) AS `", name, "`") as "kandidat" FROM campaigns WHERE subgroup_campaign_id=' . $subGroupCampaign . $whereDapilKandidat);

        $kandidat = join(", ", collect($selectKandidat)->pluck('kandidat')->toArray());

        $raw = "SELECT id, name FROM campaigns WHERE subgroup_campaign_id=$subGroupCampaign" . $whereDapilKandidat;

        $nameKandidat = DB::select($raw);

        $raw = "SELECT
                (SELECT name FROM subgroup_campaigns WHERE id=b.subgroup_campaign_id LIMIT 1) as pemilihan,
                c.kode_kabupaten,
                c.kode_kecamatan,
                c.kode_desa,
                (SELECT nama FROM wilayah WHERE kode=c.kode_kabupaten LIMIT 1) as kabupaten,
                (SELECT nama FROM wilayah WHERE kode=c.kode_kecamatan LIMIT 1) as kecamatan,
                (SELECT nama FROM wilayah WHERE kode=c.kode_desa LIMIT 1) as desa,
                $kandidat,
                SUM(1) AS total
                FROM (select * from voters_campaign WHERE voters_id IN (
                    SELECT
                        c.id
                        FROM voters c $whereDapil
                ) AND subgroup_campaign_id = $subGroupCampaign) a
                INNER JOIN campaigns b ON a.campaign_id=b.id
                INNER JOIN voters c ON a.voters_id=c.id
                GROUP BY c.kode_desa
                ORDER BY c.kode_kabupaten desc, c.kode_kecamatan desc, c.kode_desa desc";


        return array('data' => DB::select($raw), 'column' => $nameKandidat);
    }

    public function getTotalVoters($sub, $kabupatenId, $dapilId)
    {
        $whereDapil = "";

        if ((int) $sub == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapilId)";
        }

        if (in_array((int) $sub, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapilId)";
        }

        if ((int) $sub == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupatenId' ";
        }

        $raw = "SELECT
                    COUNT(c.id) as total
                    FROM voters c $whereDapil";

        $data = DB::select($raw);


        return $data[0]->total;
    }

    public function getTimsesTotalVoters($sub, $kabupatenId, $dapilId)
    {
        $whereDapil = "";

        if ((int) $sub == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapilId)";
        }

        if (in_array((int) $sub, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapilId)";
        }

        if ((int) $sub == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupatenId' ";
        }

        $raw = "SELECT
                    COUNT(c.id) as total
                    FROM voters c $whereDapil";

        $data = DB::select($raw);


        return $data[0]->total;
    }

    public function getTotalPolling($subgroupCampaignId, $kabupaten, $dapil)
    {
        $whereDapil = "";

        if ((int) $subgroupCampaignId == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if (in_array((int) $subgroupCampaignId, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if ((int) $subgroupCampaignId == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupaten' ";
        }


        $raw = "SELECT count(G.voters_id) as total FROM (SELECT
                a.voters_id
                FROM voters_campaign a WHERE a.voters_id IN (
                    SELECT
                    c.id
                    FROM voters c $whereDapil
                ) AND a.subgroup_campaign_id=$subgroupCampaignId) as G";
        $data = DB::select($raw);
        return $data[0]->total;
    }

    public function getTimsesTotalPolling($subgroupCampaignId, $kabupaten, $dapil, $timsesId)
    {
        $whereDapil = "";

        if ((int) $subgroupCampaignId == 6) {
            $whereDapil = "WHERE c.kode_kecamatan IN (SELECT
                            kode_kecamatan
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if (in_array((int) $subgroupCampaignId, [3, 5])) {
            $whereDapil = "WHERE c.kode_kabupaten IN (SELECT
                            kode_kabupaten
                            FROM dapil_wilayah WHERE dapil_id=$dapil)";
        }

        if ((int) $subgroupCampaignId == 2) {
            $whereDapil = " WHERE c.kode_kabupaten = '$kabupaten' ";
        }


        $raw = "SELECT count(G.voters_id) as total FROM (SELECT
                a.voters_id
                FROM voters_campaign a WHERE a.voters_id IN (
                    SELECT
                    c.id
                    FROM voters c $whereDapil
                ) AND a.subgroup_campaign_id=$subgroupCampaignId AND a.timses_id = $timsesId) as G";
        $data = DB::select($raw);
        return $data[0]->total;
    }

}