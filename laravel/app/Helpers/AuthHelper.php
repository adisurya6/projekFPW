<?php

use Illuminate\Support\Facades\Auth;

function aldLogin(){
    if(Auth::guard('web')->check() || Auth::guard('company')->check()){
        return true;
    }else{
        return false;
    }
}

function getAuthUser()
{
    if(aldLogin() == false){
        return false;
    }else{
        if(Auth::guard('web')->check()){
            return auth::guard('web')->user();
        }else{
            return Auth::guard('company')->user();
        }
    }
}

?>
