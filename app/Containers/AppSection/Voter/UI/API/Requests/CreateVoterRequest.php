<?php

namespace App\Containers\AppSection\Voter\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class CreateVoterRequest extends ParentRequest
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        // 'id',
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nkk' => 'required',
            'nik' => 'required',
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kawin' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'difabel' => 'required',
            'tps' => 'required',
            'kode_provinsi' => 'required',
            'kode_kabupaten' => 'required',
            'kode_kecamatan' => 'required',
            'kode_desa' => 'required',
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
