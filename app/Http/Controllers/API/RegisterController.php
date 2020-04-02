<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Mail;

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
     * Forgot password api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request, $id=null)
    {
        $id = decrypt($id);
        if($request->email){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user_details = User::where('email', $request->email)->first();
            if($user_details){
                $email = array('email' => $user_details->email);
                $code = rand(0000,9999).$user_details->id;
                $data = [
                    "forgot_password_link" => $code
                ];
                $updated_user_details = User::where('id', $user_details->id)->update($data);
                $data["url"] = route('forgot_password', encrypt($code));
                Mail::send('forgot_password_mail', $data, function($message) use($email) {
                    $message->to($email['email'], 'testing')->subject
                       ('MHADA Control Room Login');
                    $message->from('noreply@gmail.com');
                });
                return json_encode($user_details);
            }
        }

        if($id !== null){
            $user_details = User::where([
                ['forgot_password_link', '=', $id]
            ])->first();
            
            dd($user_details);
            
            if($otp_details){
                $otp_arr = [
                    "otp" => null
                ];
               $update_otp = User::where('email', $request->email)->update($otp_arr);
               return json_encode(array("success" => "Password generated successfully!"));
            }else{
                return json_encode(array("msg" => "Invalid OTP!"));
            }

        }
    }

}
