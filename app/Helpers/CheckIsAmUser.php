<?php

namespace App\Helpers;
use App\Models\User;
use App\Models\UserAMmodel;
use Illuminate\Support\Facades\Auth;

class CheckIsAmUser
{

    public static function checkIsAmUser(){

        $email = Auth::user()->email;

        $is_users = User::where('email', $email)->get();
        $is_user_am = '';

        foreach($is_users as $is_user){
            $is_user_am = $is_user->is_am;
        }


        if($is_user_am == 'yes'){
                $userAM =  UserAMmodel::where('email', $email)->get();
                if($userAM->count() == 1){
                    foreach($userAM as $user){
                        $partnerCode = $user->partner_code;

                    }

                    if($partnerCode == null){
                        return '';
                    }

                    return $partnerCode;

                }else{
                    return '';
                }
        }else{
            return null;
        }


    }

}
