<?php

namespace App\Containers\AppSection\Area\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run()
    {

        $path = storage_path('wilayah.sql');
        DB::unprepared(file_get_contents($path));

    }
}
