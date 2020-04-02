<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Mail;
use App\PasswordReset;

use GuzzleHttp\Client;

class ResetPassword{

    /**
     * check verified email for forgot password
     *
     * @return \Illuminate\Http\Response
     */
    public function checkVerifiedEmail($request){
        if($request['email']){
            $validator = Validator::make($request, [
                'email' => 'required|email'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user_details = User::where('email', $request['email'])->first();
            if($user_details){
                $email = array('email' => $user_details->email);
                $code = rand(0000,9999).$user_details->id;
                $data = [
                    "token" => $code
                ];
                $get_email_details = PasswordReset::where('email', $request['email'])->first();
                if($get_email_details){
                    $email_details = PasswordReset::where('email', $request['email'])->update($data);
                }else{
                    $data['email'] = $request['email'];
                    $email_details = PasswordReset::create($data);
                }
                if($email_details){
                    $data["url"] = route('reset_password_link', encrypt($code));
                    Mail::send('forgot_password_mail', $data, function($message) use($email) {
                        $message->to($email['email'], 'testing')->subject
                           ('MHADA Control Room password reset');
                        $message->from('amarpr94@gmail.com');
                    });
                    return $user_details;
                }
            }else{
                return json_encode(array("error" => "Email address not found!"));
            }
        }
    }

    /**
     * reset password link for forgot password
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPasswordLink($id){
        if($id !== null){
            $id = decrypt($id);
            $email_details = PasswordReset::where([
                ['token', '=', $id]
            ])->first();

            if($email_details){
                $user_details = User::where('email', $email_details->email)->first();
                if($user_details){
                    return json_encode($user_details);
                }else{
                    return json_encode(array("msg" => "Email address not found!"));
                }
            }else{
                return json_encode(array("msg" => "Invalid Link!"));
            }

        }
    }

    /**
     * update password for forgot password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword($request){
        $validator = Validator::make($request, [
            'id' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $id = decrypt($request['id']);
        $email_details = PasswordReset::where([
            ['email', $request['email']],
            ['token', $id]
        ])->first();

        if($email_details){
            $data['password'] = bcrypt($request['password']);
            $updated_user_details = User::where('email', $email_details->email)->update($data);
            if($updated_user_details){
                $deleted_record = PasswordReset:: where('email', $email_details->email)->delete();
                return json_encode(array("msg" => "Password reset successfully!"));
            }else{
                return json_encode(array("msg" => "Email address not found!"));
            }
        }else{
            return json_encode(array("msg" => "Invalid token passed!"));
        }
    }

}