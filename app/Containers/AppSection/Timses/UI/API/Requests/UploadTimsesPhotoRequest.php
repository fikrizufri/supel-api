<?php

namespace App\Containers\AppSection\Timses\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class UploadTimsesPhotoRequest extends ParentRequest
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
