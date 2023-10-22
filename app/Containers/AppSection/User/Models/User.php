<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\AppSection\Authorization\Models\ModelHasRole;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;
use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\Password;

class User extends ParentUserModel implements MustVerifyEmail
{
    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;

    protected $fillable = [
        'campaign_id',
        'phone',
        'name',
        'email',
        'password',
        'gender',
        'birth',
        'group_id',
        'kode_partai',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'date',
    ];

    public static function getPasswordValidationRules(): Password
    {
        return Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols();
    }

    public function sendEmailVerificationNotificationWithVerificationUrl(string $verificationUrl): void
    {
        $this->notify(new VerifyEmail($verificationUrl));
    }
}
