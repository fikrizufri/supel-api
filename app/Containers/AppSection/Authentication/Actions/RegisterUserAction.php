<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Tasks\CreateTimsesTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterUserAction extends ParentAction
{

    public function run(RegisterUserRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'name',
            'phone',
            'email',
            'password',
        ]);

        $cekNik = Timses::whereNik($request->nik)->first();

        if ($cekNik) {
            throw new ValidationFailedException('Nik KTP sudah didaftarkan');
        }

        $user = app(CreateUserByCredentialsTask::class)->run($sanitizedData);

        if ($user) {
            $role = app(FindRoleTask::class)->run($request->role_name, 'api');
            app(AssignRolesToUserTask::class)->run($user, $role);
        }

        $timsesData = [
            'user_id' => $user->id,
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'status' => 'unapproved'
        ];

        app(CreateTimsesTask::class)->run($timsesData);

        $token = $user->createToken('Access Token')->accessToken;

        //$user->notify(new Welcome());
        //app(SendVerificationEmailTask::class)->run($user, $request->verification_url);

        return [
            "token_type" =>  "Bearer",
            "expires_in" => 86400,
            'access_token' => $token,
        ];



    }
}
