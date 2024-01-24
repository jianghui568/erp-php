<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Hash;

trait PasswordTrait
{
    public static function encryPassword($password)
    {
        return Hash::make($password);
    }

    public static function checkPassword($password, $hashPassword)
    {
        return Hash::check($password, $hashPassword);
    }
}
