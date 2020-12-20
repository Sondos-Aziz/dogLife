<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Mail\SendCode;
use Illuminate\Http\Request;
use App\Models\EmailVerifications;
use App\Http\Controllers\Controller;
use App\Traits\GeneralResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    use GeneralResponseTrait;
 /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPasswordEmail(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        $validator =Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }

        $this->sendCodeEmail($request->email, 'Your reset password code is ');

        return $this->mainResponse(true, 'We sent reset code to your email', [], [], 200);
    }

/////////////////////////////////$this->sendCodeEmail
 public function sendCodeEmail($email, $message)
    {
        $code = str_replace('0', '1', \Carbon\Carbon::now()->timestamp);
        $code = str_shuffle($code);
        $code = substr($code, 0, 6);

        Mail::to($email)->send(new SendCode($message . $code));

        EmailVerifications::query()->where('email', $email)->delete();
        EmailVerifications::query()->insert(['email' => $email, 'code' => bcrypt($code),'type' => 1]);
        return $this->mainResponse(true, __('ok'), [], []);
    }

/////////////////////////////////VerfiyCode
 /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyCodeFromEmail(Request $request)
    {
        $email_code = EmailVerifications::query()->where('email', $request->email)->where('type',1)->first();

        $rules = [
            'email' => 'required|email|exists:email_verifications',
            'code'  => 'required|hash_check:' . @$email_code->code,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }

        $code = str_replace('0', '', \Carbon\Carbon::now()->timestamp);
        $code = str_shuffle($code);
        $code = substr($code, 0, 6);
        EmailVerifications::query()->where('email', $request->email)->update(['code' => bcrypt($code),'type' => 2]);

        return $this->mainResponse(true, __('ok'), $code, [], 200);
    }


/////////////////////////////////ResetPassword
 /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $code = EmailVerifications::query()->where('email', $request->email)->first();
        $rules = [
            'email' => 'email|exists:email_verifications,email|exists:users,email',
            'code' => 'required|hash_check:' . @$code->code,
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }

        if ($request->email){
            User::query()->where('email', $request->email)
                ->update(['password' =>Hash::make($request->password)]);
            EmailVerifications::query()->where('email', $request->email)->delete();
        }

        return $this->mainResponse(true, 'Your password reset successfully, please login', [], [], 200);
    }



}
