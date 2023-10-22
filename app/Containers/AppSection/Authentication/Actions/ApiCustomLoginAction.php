<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Hash;

class ApiCustomLoginAction extends ParentAction
{

    public function run(LoginRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            [
                'username',
                'password',
            ]
        );

        $user = User::where('email', $sanitizedData['username'])->first();

        if (!$user) {
            throw new LoginFailedException('The user credentials were incorrect.');
        }

        if (! Hash::check($sanitizedData['password'], $user->password)) {
            throw new LoginFailedException('The user credentials were incorrect.');
        }

        $token = $user->createToken('Access Token')->accessToken;
        $role = $user->roles()->first();
        $timses = Timses::where('user_id', $user->id)->first();

        $campaignId = null;

        if ($timses) {
            $campaignId = $timses->default_campaign_id;
        }

        if ($user->campaign_id != null) {
            $campaignId = $user->campaign_id;
        }

        return [
            "token_type" =>  "Bearer",
            "expires_in" => 86400,
            'access_token' => $token,
            'user' => $user,
            'role_name' => $role ? $role->name : '',
            'campaign_id' => $campaignId,
        ];
    }

}
