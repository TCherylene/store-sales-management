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

	public static function format_number($num, $prec = 2, $sep = ',', $dec = ".")
	{
		if (!is_numeric($num)) {
			return '';
		}
		$int = (int) $num;
		$precision = ($num == $int) ? 0 : $prec;
		return number_format($num, $precision, $dec, $sep);
	}
}
