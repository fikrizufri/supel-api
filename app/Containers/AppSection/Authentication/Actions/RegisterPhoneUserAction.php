<?php

namespace App\Containers\AppSection\Authentication\Actions;


use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterPhoneUserRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterPhoneUserAction extends ParentAction
{

    public function run(RegisterPhoneUserRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'phone',
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
