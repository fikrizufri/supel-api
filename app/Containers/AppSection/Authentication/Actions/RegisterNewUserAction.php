<?php

namespace App\Containers\AppSection\Authentication\Actions;


use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterNewUserRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterNewUserAction extends ParentAction
{

    public function run(RegisterNewUserRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
        ]);

        $user = app(CreateUserByCredentialsTask::class)->run($sanitizedData);

        $token = $user->createToken('Access Token')->accessToken;

        return array(
            'user' => $user,
            'token' => [
                "token_type" => "Bearer",
                "expires_in" => 86400,
                'access_token' => $token,
            ]);
    }
}
