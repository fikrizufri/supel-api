<?php

namespace App\Containers\AppSection\Timses\Actions;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\Tasks\UpdateTimsesCardTask;
use App\Containers\AppSection\Timses\Tasks\UploadImageTask;
use App\Containers\AppSection\Timses\UI\API\Requests\UploadTimsesPhotoRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;

class UploadTimsesPhotoAction extends ParentAction
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

        if ($imgFile = $request->file('photo')) {

            $UploadImg = app(UploadImageTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                $dataCard = app(UpdateTimsesCardTask::class)->run([
                    'photo' => $img
                ], $dataCard->id);

            }

        }

        $card = TimsesCard::whereTimsesId($timses->id)->first();

        $image = \SnappyImage::loadView('appSection@timses::card', compact('card'));

        $date = Carbon::now()->format("mdYhi");

        $fileName = $dataCard->id_card . '-card-' . $date.  '.jpg';

        $file = public_path('storage/' . $fileName );

        if (file_exists($file)) {
            unlink($file);
        }

        $image->save($file);

        $card->image_generate = $fileName;

        $card->save();

        $timsescard = TimsesCard::whereTimsesId($timses->id)->first();

        return $timsescard;
    }
}
