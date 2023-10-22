<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class RegisterPhoneUserRequest extends ParentRequest
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

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    public function rules(): array
    {
        return [
            'phone' => 'required|numeric|unique:users,phone',
            'password' =>  'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Nomor hp tidak boleh kosong.',
            'phone.numeric' => 'Nomor hp harus berupa angka.',
            'phone.unique' => 'Nomor hp sudah digunakan.',
            'password.required' =>  'Kata sandi tidak boleh kosong.',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
