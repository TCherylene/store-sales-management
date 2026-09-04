<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function get_user()
    {
        $user = Auth::user();
        return $user;
    }
}
