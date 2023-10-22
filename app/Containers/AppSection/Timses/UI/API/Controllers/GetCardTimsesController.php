<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;


use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\UI\API\Requests\GetAllTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesCampaignSelectTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetCardTimsesController extends ApiController
{
    public function get(GetAllTimsesRequest $request)
    {
        $card = TimsesCard::whereTimsesId(128)->first();

        return view('appSection@timses::card', compact('card'));
    }
}
