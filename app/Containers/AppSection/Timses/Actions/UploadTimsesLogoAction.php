<?php

namespace App\Containers\AppSection\Timses\Actions;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\Tasks\UpdateTimsesCardTask;
use App\Containers\AppSection\Timses\Tasks\UploadLogoOrgTask;
use App\Containers\AppSection\Timses\UI\API\Requests\UploadTimsesPhotoRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UploadTimsesLogoAction extends ParentAction
{
    public function run(UploadTimsesPhotoRequest $request): TimsesCard
    {
        $user =  $request->user();

        $timses = Timses::whereUserId($user->id)->first();

        if(!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        $dataCard = TimsesCard::whereTimsesId($timses->id)->first();

        if(!$dataCard) {
            throw new NotFoundException('Data timses card tidak ditemukan.');
        }

        if ($imgFile = $request->file('logo')) {

            $UploadImg = app(UploadLogoOrgTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                app(UpdateTimsesCardTask::class)->run([
                    'logo_organisasi' => $img
                ], $dataCard->id);

            }

        }

        $card = TimsesCard::whereTimsesId($timses->id)->first();

        $image = \SnappyImage::loadView('appSection@timses::card', compact('card'));

        $file = public_path('storage/' . $dataCard->id_card . '-card.jpg' );

        if (file_exists($file)) {
            unlink($file);
        }

        $image->save($file);

        $card->image_generate = $dataCard->id_card . '-card.jpg';

        $card->save();

        return $dataCard;
    }
}
