<?php

namespace App\Ship\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BulkKandidatCommand extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bulk:kandidat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'bulk data kandidat caleg';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info("START....");
        $this->info("Get data dapil....");
        $dapil = DB::select("select
                                dp.id as kode_dapil, dp.name, dp.subgroup,
                                (select j.group_campaign_id from simpel_db.subgroup_campaigns j where j.kode=dp.subgroup limit 1) as group_campaign_id,
                                (select j.id from simpel_db.subgroup_campaigns j where j.kode=dp.subgroup limit 1) as subgroup_campaign_id,
                                dp.total_kursi
                                from dapil dp");

        $this->info("Get data partai....");
        $partai = DB::select("select
                        pt.id as kode_partai, pt.warna, pt.singkatan
                        from partai pt where pt.id <> 4");

        $campaignId = 38;
        $this->info("loop data dapil....");
        foreach ($dapil as $index => $itemDapil) {
            for ($i=0;$i < $itemDapil->total_kursi;$i++) {
                foreach ($partai as $key => $parte) {

                    $campaignId++;
                    $group = $itemDapil->group_campaign_id;
                    $subgroup = $itemDapil->subgroup_campaign_id;
                    $kodeDapil = $itemDapil->kode_dapil;
                    $kodePartai = $parte->kode_partai;
                    $name = "Kandidat " . $parte->singkatan . " " . $itemDapil->name;
                    $image = 'caleg-noimage.jpg';
                    $warna = $parte->warna;

                    $kodeSubGroup = $itemDapil->subgroup;

                    $id_akun = '';
                    if ($kodeSubGroup === 'DPD') {
                        $id_akun = $kodeSubGroup . '11' . $campaignId;
                    }

                    if (in_array($kodeSubGroup, ['DPR', 'DPRA'])) {
                        $id_akun = $kodeSubGroup . $kodePartai . '11' . $kodeDapil . $campaignId;
                    }

                    if ($kodeSubGroup === 'DPRK') {
                        $id_akun = $kodeSubGroup . $kodePartai . '11' . '11.05' . $kodeDapil . $campaignId;
                    }

                    $kodeAkun = str_replace(".", "", $id_akun);

                    $data = [
                        'id_akun' => $kodeAkun,
                        'group_campaign_id' => $group,
                        'subgroup_campaign_id' => $subgroup,
                        'kode_subgroup_campaign' => null,
                        'kode_provinsi' => '11',
                        'kode_kabupaten' => $itemDapil->subgroup === 'DPRK' ? '11.05' : null,
                        'kode_dapil' => $kodeDapil,
                        'kode_partai' => $kodePartai,
                        'singkatan' => null,
                        'name' => $name,
                        'image' => $image,
                        'slogan' => null,
                        'warna' => $warna,
                        'date_campaign' => '2024-02-13',
                        'campaign' => 1,
                        'survey' => 1,
                        'count' => 1,
                        'active' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'nomor_urut' => $i+1,
                    ];

//                    DB::table('campaigns')->insert($data);

                    $this->info("proses " . $kodeAkun);
                }
            }

        }


    }
}
