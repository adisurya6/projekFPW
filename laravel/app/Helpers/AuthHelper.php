<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function aldLogin(){
        if(Auth::guard('web')->check() || Auth::guard('company')->check()){
            return true;
        }else{
            return false;
        }
    }

    public static function getAuthUser()
    {
        if(Auth::guard('web')->check() || Auth::guard('company')->check()){
            if(Auth::guard('web')->check()){
                return Auth::guard('web')->user();
            }else{
                return Auth::guard('company')->user();
            }
        }else{
            return false;
        }
    }
}



?>
