<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * Change password api
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        if(Auth::user()){
            $update_passwd = User::where('id', Auth::user()->id)->update(['password' => bcrypt($request->new_password)]);
            if($update_passwd){
                return json_encode(["message" => "Password updated succesfully!"]);
            }
        }
    }
}
