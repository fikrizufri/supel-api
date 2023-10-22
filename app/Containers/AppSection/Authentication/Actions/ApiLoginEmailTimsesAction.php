<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginTimsesRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Hash;

class ApiLoginEmailTimsesAction extends ParentAction
{

    public function run(LoginTimsesRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            [
                'email',
                'password',
            ]
        );

        $user = User::where('email', $sanitizedData['email'])->first();

        if (!$user) {
            throw new LoginFailedException('Email atau password yang anda masukkan salah.');
        }

        if (! Hash::check($sanitizedData['password'], $user->password)) {
            throw new LoginFailedException('Email atau password yang anda masukkan salah.');
        }

        $token = $user->createToken('Access Token')->accessToken;

        $timses = Timses::where('user_id', $user->id)->first();

        return [
            "token_type" =>  "Bearer",
            "expires_in" => 86400,
            'access_token' => $token,
            'timses' => $timses,
            'campaign_id' => $timses ? $timses->default_campaign_id : null,
        ];
    }

}
