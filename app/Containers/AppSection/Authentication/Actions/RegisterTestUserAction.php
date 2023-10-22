<?php

namespace App\Containers\AppSection\Authentication\Actions;


use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterNewUserRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterTestUserAction extends ParentAction
{
    public function run(RegisterNewUserRequest $request)
    {
        return array(
                'user' => null,
                'token' => [
                    "token_type" => "Bearer",
                    "expires_in" => 86400,
                    'access_token' => 'DFFkhasas217823407294740',
                ]);
    }
}
