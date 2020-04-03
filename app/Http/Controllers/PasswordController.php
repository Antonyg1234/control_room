<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResetPassword;

class PasswordController extends Controller
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
        $reset_passwd = json_decode($reset_passwd);
        $email = $reset_passwd->email;
        return view('reset_password', compact('email', 'id'));
    }

    /**
     * Forgot password api
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, ResetPassword $reset_passwd)
    {
        // dd($request->all());
        $request->id = decrypt($request->id);
        $reset_passwd = $reset_passwd->updatePassword($request->all());
        $reset_passwd= json_decode($reset_passwd, true);
        return view('reset_password_success');
        // return redirect()->route('reset_password_link', compact('id', 'email'))->with('success', $reset_passwd['msg']);
    }
}
