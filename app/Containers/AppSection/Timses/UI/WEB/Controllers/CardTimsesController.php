<?php

namespace App\Containers\AppSection\Timses\UI\WEB\Controllers;

use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Ship\Parents\Controllers\WebController;

class CardTimsesController extends WebController
{
	public function generateCard($id)
	{
        $card = TimsesCard::whereTimsesId($id)->first();
        return view('appSection@timses::card', compact('card'));
	}
}
