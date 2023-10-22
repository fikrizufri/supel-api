<?php

namespace App\Containers\AppSection\Voter\UI\CLI\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\PdfToText\Pdf;

class VotersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voters:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data DPTHP';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("TEST COMMAND");
        $csvFileName = storage_path() . "/dpt-clean.csv";

        $this->info($csvFileName);

        $text = $this->readCSV($csvFileName,array('delimiter' => ';'));

        foreach (array_chunk($text, 20000) as $key => $data) {
            foreach ($data as $value) {
                $this->info('INSERT : ' . $value[3]);
                DB::table('voters')->insert([
                    'data_id' => $value[0],
                    'nkk' => $value[1],
                    'nik' => $value[2],
                    'name' => $value[3],
                    'tempat_lahir' => $value[4],
                    'tanggal_lahir' => $value[5],
                    'kawin' => $value[6],
                    'jenis_kelamin' => $value[7],
                    'alamat' => $value[8],
                    'rt' => $value[9],
                    'rw' => $value[10],
                    'difabel' => $value[11],
                    'tps' => $value[12],
                    'kode_provinsi' => $value[13],
                    'kode_kabupaten' => $value[14],
                    'kode_kecamatan' => $value[15],
                    'kode_desa' => $value[16],
                ]);
            }
        }

        return 0;
    }

    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }
}
