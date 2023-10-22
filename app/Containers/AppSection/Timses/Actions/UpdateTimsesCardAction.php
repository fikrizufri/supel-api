<?php

namespace App\Containers\AppSection\Timses\Actions;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\Tasks\UpdateTimsesCardTask;
use App\Containers\AppSection\Timses\Tasks\UploadImageTask;
use App\Containers\AppSection\Timses\Tasks\UploadLogoOrgTask;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesCardRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateTimsesCardAction extends ParentAction
{
    public function run(UpdateTimsesCardRequest $request): TimsesCard
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

        $data = $request->sanitizeInput([
            'name',
            'id_card',
            'kode_province',
            'kode_kabupaten',
            'kode_kecamatan',
            'kode_desa',
            'nama_organisasi',
            'slogan_organisasi',
            'alamat_organisasi',
            'tanggal_berlaku',
            'email_organisasi',
            'telephone_organisasi',
            'warna',
        ]);

        $timses->kode_kabupaten = $data['kode_kabupaten'];

        $timses->kode_kecamatan = $data['kode_kecamatan'];

        $timses->kode_desa = $data['kode_desa'];

        $timses->save();

        $saveCard = app(UpdateTimsesCardTask::class)->run($data, $dataCard->id);

        if ($imgFile = $request->file('photo')) {

            $UploadImg = app(UploadImageTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                app(UpdateTimsesCardTask::class)->run([
                    'photo' => $img
                ], $saveCard->id);

            }

        }

        if ($imgFile = $request->file('logo_organisasi')) {

            $UploadImg = app(UploadLogoOrgTask::class)->run($imgFile);

            if (!empty($UploadImg)) {

                $img = $UploadImg['image'];

                app(UpdateTimsesCardTask::class)->run([
                    'logo_organisasi' => $img
                ], $saveCard->id);

            }

        }

        $card = TimsesCard::whereTimsesId($timses->id)->first();

        $image = \SnappyImage::loadView('appSection@timses::card', compact('card'));

        $file = public_path('storage/' . $data['id_card'] . '-card.jpg' );

        if (file_exists($file)) {
            unlink($file);
        }

        $image->save($file);

        $card->image_generate = $data['id_card'] . '-card.jpg';

        $card->save();

        return $card;
    }
}
