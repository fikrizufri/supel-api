<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authentication\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class GetAuthenticatedUserController extends ApiController
{

    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request)
    {
        $user = app(GetAuthenticatedUserAction::class)->run($request);

        if($user->hasRole('superadmin')) {
            $data = [
                'user' => $user,
            ];
            return $this->json($data);
        }

        if($request->get('for_roles') === 'admin') {

            return $this->transform($user, UserTransformer::class);

        }

        if($user->hasRole('adminkandidat')) {

            $campaign = null;

            if($user->campaign_id != null) {
                $campaign = Campaign::where('campaigns.id', $user->campaign_id)
                    ->join('subgroup_campaigns', 'campaigns.subgroup_campaign_id', 'subgroup_campaigns.id')
                    ->select([
                        'campaigns.*',
                        'subgroup_campaigns.name as pemilihan',
                        DB::raw('(select j.name from dapil j where j.id=campaigns.kode_dapil) as dapil_name')
                    ])
                    ->first();
            }

            $data = [
                'user' => $user,
                'campaign' => $campaign
            ];

            return $this->json($data);

        }

        $timses = null;

        if ($user) {
            $timses = Timses::whereUserId($user->id)->first();
        }

        $card = null;

        $campaign = null;

        if ($timses) {
            if($timses->default_campaign_id != null) {
                $campaign = Campaign::where('id_akun', $timses->default_campaign_id)
                    ->join('subgroup_campaigns', 'campaigns.subgroup_campaign_id', 'subgroup_campaigns.id')
                    ->select([
                        'campaigns.*',
                        'subgroup_campaigns.name as pemilihan',
                        DB::raw('(select j.name from dapil j where j.id=campaigns.kode_dapil) as dapil_name')
                    ])
                    ->first();

                $card = TimsesCard::whereTimsesId($timses->id)->where('campaign_id', $timses->default_campaign_id)->first();

            }
        }

        $data = [
            'user' => $user,
            'timses' => $timses,
            'card' => $card,
            'campaign' => $campaign
        ];

        if($request->get('filter') === 'campaign') {
            $data = [
                'campaign' => $campaign
            ];
        }

        return $this->json($data);
    }
}
