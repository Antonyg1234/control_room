<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Mail;
use App\Services\ResetPassword;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();

            return $this->sendResponse([], 'User logged out successfully.');
        }
    }

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
        $reset_passwd = $reset_passwd->updatePassword($request->all());
        return $reset_passwd;
    }

}
