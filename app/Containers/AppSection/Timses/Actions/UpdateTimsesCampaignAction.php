<?php

namespace App\Containers\AppSection\Timses\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Partai\Models\Partai;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesCampaignRequest;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateTimsesCampaignAction extends ParentAction
{
    /**
     * @param UpdateTimsesRequest $request
     * @return Timses
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateTimsesCampaignRequest $request): Timses
    {
        $data = $request->sanitizeInput([
            'campaign_id',
        ]);

        $timses = Timses::whereId($request->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        if ($timses->default_campaign_id === strtoupper($data['campaign_id'])) {
            throw new ValidationFailedException('Kandidat sudah default.');
        }

        $campaign = Campaign::whereIdAkun(strtoupper($data['campaign_id']))->first();

        if (!$campaign) {
            throw new NotFoundException('Data kandidat tidak ditemukan.');
        }

        $cekDataCard = TimsesCard::where('timses_id', $timses->id)->where('campaign_id', strtoupper($data['campaign_id']))->first();

        if (!$cekDataCard) {

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

            $card = TimsesCard::create($dataCard);

            $image = \SnappyImage::loadView('appSection@timses::card', compact('card'));

            $file = public_path('storage/' . $idAkun . '-card.jpg');

            if (file_exists($file)) {
                unlink($file);
            }

            $image->save($file);

            $card->image_generate = $idAkun . '-card.jpg';
            $card->campaign_id = strtoupper($data['campaign_id']);

            $card->save();
        }

        $timses->default_campaign_id = strtoupper($data['campaign_id']);

        $timses->save();

        return $timses;
    }
}
