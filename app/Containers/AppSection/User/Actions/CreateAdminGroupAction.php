<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminKandidatRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\DB;

class CreateAdminGroupAction extends ParentAction
{

    public function run(CreateAdminKandidatRequest $request)
    {
        $data = $request->sanitizeInput([
            'campaign_id',
            'name',
            'email',
            'password',
            'role',
            'group_id',
            'kode_partai',
        ]);

        return DB::transaction(function () use ($data) {
            $user = app(CreateUserByCredentialsTask::class)->run($data);
            $adminRoleName = empty($data->role) ? 'adminkandidat' : $data->role;

            $adminRole = app(FindRoleTask::class)->run($adminRoleName, 'api');
            app(AssignRolesToUserTask::class)->run($user, $adminRole);

            $user->email_verified_at = now();
            $user->save();

            return $user;
        });
    }
}
