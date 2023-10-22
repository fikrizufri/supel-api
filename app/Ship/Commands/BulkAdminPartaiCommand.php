<?php

namespace App\Ship\Commands;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Ship\Parents\Commands\ConsoleCommand;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BulkAdminPartaiCommand extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bulk:admin';

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
        $this->info("Get data partai....");
        $partai = DB::select("select
                        pt.id as kode_partai, pt.warna, pt.singkatan
                        from partai pt");

        foreach ($partai as $key => $parte) {

            $userData = [
                'email' => 'admin.partai@'.strtolower($parte->singkatan).'.id',
                'password' => 'demo123',
                'name' => 'Admin ' .strtolower($parte->singkatan),
                'kode_partai' => $parte->kode_partai
            ];

            $user = app(CreateUserByCredentialsTask::class)->run($userData);

            $adminRole = app(FindRoleTask::class)->run('adminpartai', 'api');
            app(AssignRolesToUserTask::class)->run($user, $adminRole);

            $user->email_verified_at = now();
            $user->save();

            $this->info("proses " . strtolower($parte->singkatan));

        }


    }
}
