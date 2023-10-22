<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationRolesSeeder_2 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Roles for every Guard ----------------------------------------------------------------
        app(CreateRoleTask::class)->run(config('appSection-authorization.admin_role'), 'Super Administrator', 'Super Administrator Role', 'api');
        // app(CreateRoleTask::class)->run('admin', 'Admin', 'Administrator Role', 'api');
        app(CreateRoleTask::class)->run('timseskabupaten', 'Timses Kabupaten', 'Timses Kabupaten Role', 'api');
        app(CreateRoleTask::class)->run('timseskecamatan', 'Timses Kecamatan', 'Timses Kecamatan Role', 'api');
        app(CreateRoleTask::class)->run('timsesdesa', 'Timses Desa', 'Timses Desa Role', 'api');
    }
}