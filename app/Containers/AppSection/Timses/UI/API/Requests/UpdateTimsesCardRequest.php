<?php

namespace App\Containers\AppSection\Timses\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class UpdateTimsesCardRequest extends ParentRequest
{

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];


    protected array $decode = [

    ];


    protected array $urlParameters = [

    ];


    public function rules(): array
    {
        return [
            'name' => '',
            'id_card' => '',
            'kode_province' => '',
            'kode_kabupaten' => '',
            'kode_kecamatan' => '',
            'kode_desa' => '',
            'photo' => '',
            'nama_organisasi' => '',
            'slogan_organisasi' => '',
            'logo_organisasi' => '',
            'alamat_organisasi' => '',
            'tanggal_berlaku' => '',
            'email_organisasi' => '',
            'telephone_organisasi' => '',
            'warna' => '',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
