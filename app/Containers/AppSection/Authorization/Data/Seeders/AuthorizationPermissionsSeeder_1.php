<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationPermissionsSeeder_1 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Permissions for every Guard ----------------------------------------------------------
//        $createPermissionTask = app(CreatePermissionTask::class);
//        $createPermissionTask->run('manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.', guardName: 'api');
//        $createPermissionTask->run('create-admins', 'Create new Users (Admins) from the dashboard.', guardName: 'api');
//        $createPermissionTask->run('manage-admins-access', 'Assign users to Roles.', guardName: 'api');
//        $createPermissionTask->run('access-dashboard', 'Access the admins dashboard.', guardName: 'api');
//        $createPermissionTask->run('access-private-docs', 'Access the private docs.', guardName: 'api');
    }
}
