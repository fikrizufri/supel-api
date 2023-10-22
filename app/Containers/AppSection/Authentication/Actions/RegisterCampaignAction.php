<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterCampaignRequest;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\Tasks\CreateTimsesTask;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterCampaignAction extends ParentAction
{

    public function run(RegisterCampaignRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'campaign_id',
            'saksi',
        ]);

        $campaign = Campaign::whereIdAkun(strtoupper($sanitizedData['campaign_id']))->first();

        if (!$campaign) {
            throw new NotFoundException('Data kandidat tidak ditemukan.');
        }

        $user = $request->user();

        if (!$user) {
            throw new NotFoundException('Data user tidak ditemukan.');
        }

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        $cekData = TimsesCampaign::where('timses_id', $timses->id)->where('campaign_id', strtoupper($sanitizedData['campaign_id']))->first();

        if ($cekData) {
            throw new ValidationFailedException('Data kandidat sudah didaftarkan.');
        }

        $singkatan = $campaign->singkatan;
        $num_padded = sprintf("%02d", $timses->id);
        $idAkun = $singkatan . $timses->created_at->format('Ymd') . $num_padded;

        $namaOrganisasi = 'Relawan ' . $campaign->name;

        $sloganOrganisasi = $campaign->slogan;

        $logo = $campaign->image;

        $alamat = '';

        $email = '';

        $warna = $campaign->warna;

        if ($campaign->partai != null) {
            $partai = Partai::whereId($campaign->kode_partai)->first();
            $namaOrganisasi = $partai->name;
            $sloganOrganisasi = $partai->slogan;
            $logo = $partai->simbol;
            $alamat = $partai->alamat;
            $email = $partai->email;
            $warna = $partai->warna;
        }

        $dataCard = [
            'timses_id' => $timses->id,
            'name' => $timses->name,
            'id_card' => $idAkun,
            'kode_province' => $campaign->kode_provinsi,
            'kode_kabupaten' => $campaign->kode_kabupaten,
            'kode_kecamatan' => NULL,
            'kode_desa' => NULL,
            'nama_organisasi' => $namaOrganisasi,
            'slogan_organisasi' => $sloganOrganisasi,
            'logo_organisasi' => $logo,
            'alamat_organisasi' => $alamat,
            'tanggal_berlaku' => NULL,
            'email_organisasi' => $email,
            'warna' => $warna,
            'telephone_organisasi' => NULL,
        ];

        TimsesCard::create($dataCard);

        TimsesCampaign::create([
            'timses_id' => $timses->id,
            'campaign_id' => strtoupper($sanitizedData['campaign_id']),
            'saksi' => $sanitizedData['saksi'],
            'status' => 'unapproved',
        ]);

        $timses->default_campaign_id = strtoupper($sanitizedData['campaign_id']);

        $timses->kode_province = $campaign->kode_provinsi;

        $timses->kode_kabupaten = $campaign->kode_kabupaten;

        $timses->id_akun = $idAkun;

        $timses->save();

        $card = TimsesCard::whereTimsesId($timses->id)->first();

        $image = \SnappyImage::loadView('appSection@timses::card', compact('card'));

        $file = public_path('storage/' . $idAkun . '-card.jpg');

        if (file_exists($file)) {
            unlink($file);
        }

        $image->save($file);

        $card->image_generate = $idAkun . '-card.jpg';
        $card->campaign_id = strtoupper($sanitizedData['campaign_id']);

        $card->save();

        return [
            "campaign_id" => strtoupper($sanitizedData['campaign_id']),
            "url_card" => url('/storage/' . $idAkun . '-card.jpg'),
        ];

    }
}
