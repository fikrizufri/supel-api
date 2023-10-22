<?php

namespace App\Containers\AppSection\Authentication\Actions;


use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterNewCampaignRequest;
use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\Tasks\CreateTimsesTask;
use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;

class RegisterNewCampaignAction extends ParentAction
{

    public function run(RegisterNewCampaignRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'voter_id',
            'campaign_id',
            'saksi',
            'role',
        ]);

        $voter = Voter::whereId($sanitizedData['voter_id'])->first();

        if (!$voter) {
            throw new NotFoundException('Data dpt tidak diketemukan.');
        }

        $campaign = Campaign::whereIdAkun(strtoupper($sanitizedData['campaign_id']))->first();

        if (!$campaign) {
            throw new NotFoundException('Data kandidat tidak ditemukan.');
        }

        $user = $request->user();

        if (!$user) {
            throw new NotFoundException('Data user tidak ditemukan.');
        }

        $user->name = $voter->name;
        $user->save();

        if ($user) {
            $role = app(FindRoleTask::class)->run($sanitizedData['role'], 'api');
            app(AssignRolesToUserTask::class)->run($user, $role);
        }

        $checkDuplicateTimses = Timses::where('user_id', $user->id)->select('id')->first();

        if ($checkDuplicateTimses) {
            throw new NotFoundException('Data timses untuk user tersebut sudah didaftarkan.');
        }

        $timsesData = [
            'user_id' => $user->id,
            'name' => $voter->name,
            'nick_name' => $voter->name,
            'nik' => $voter->nik,
            'kode_province' => $voter->kode_provinsi,
            'kode_kabupaten' => $voter->kode_kabupaten,
            'kode_kecamatan' => $voter->kode_kecamatan,
            'kode_desa' => $voter->kode_desa,
            'default_campaign_id' => $campaign->id_akun,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $timses = app(CreateTimsesTask::class)->run($timsesData);

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
            "campaign" => strtoupper($sanitizedData['campaign_id']),
            "card" => url('/storage/' . $idAkun . '-card.jpg'),
            "timses" => $timses,
        ];

    }
}
