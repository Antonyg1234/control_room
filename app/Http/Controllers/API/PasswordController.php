<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Mail;
use App\Services\ResetPassword;

class PasswordController extends BaseController
{
    

    /**
     * Forgot password api
     *
     * @return \Illuminate\Http\Response
     */
    public function checkVerifiedEmail(Request $request, ResetPassword $reset_passwd)
    {
        $reset_passwd = $reset_passwd->checkVerifiedEmail($request->all());
        return json_encode($reset_passwd);
    }

    /**
     * Forgot password api
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPasswordLink($id, ResetPassword $reset_passwd)
    {
        $reset_passwd = $reset_passwd->resetPasswordLink($id);
        return $reset_passwd;
    }

    /**
     * Forgot password api
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, ResetPassword $reset_passwd)
    {
        $request->id = decrypt($request->id);
        $reset_passwd = $reset_passwd->updatePassword($request->all());
        return $reset_passwd;
    }
}
