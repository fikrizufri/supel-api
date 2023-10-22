<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginTimsesRequest;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Hash;

class ApiLoginTimsesAction extends ParentAction
{

    public function run(LoginTimsesRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            [
                'phone',
                'password',
            ]
        );

        $user = User::where('phone', $sanitizedData['phone'])->first();

        if (!$user) {
            throw new LoginFailedException('Nomor handphone atau password yang anda masukan salah.');
        }

        if (! Hash::check($sanitizedData['password'], $user->password)) {
            throw new LoginFailedException('Nomor handphone atau password yang anda masukan salah.');
        }

        $token = $user->createToken('Access Token')->accessToken;

        $timses = Timses::where('user_id', $user->id)->first();

        return [
            "token_type" =>  "Bearer",
            "expires_in" => 86400,
            'access_token' => $token,
            'timses' => $timses?->id,
            'campaign_id' => $timses?->default_campaign_id,
        ];
    }

}
