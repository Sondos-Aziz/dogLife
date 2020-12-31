<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\MobileToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\GeneralResponseTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use GeneralResponseTrait,ImageTrait;

    public function login(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
                'fcm_token' =>'required|string|max:255',
            'device' =>'required|in:android,ios',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                //   return  $this->mainResponse(false, __('messages.error validation'), null,$validator, 001);
                  return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);
                }
            //login
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                // $user = DB::table('users')->find(Auth::user()->id);
                $user = User::query()->find(Auth::user()->id);
                $user['token'] =  $user->createToken('MyApp')->accessToken;
                MobileToken::query()->updateOrCreate(
                    ['user_id' => $user->id, 'token' =>$request->fcm_token , 'device' => $request->device],
                    ['user_id' => $user->id, 'token' =>$request->fcm_token , 'device' => $request->device] );
                return  $this->mainResponse(true, __('messages.success'), $user, [], 200);
            } else {
                return  $this->mainResponse(false, __('messages.unauthorized'), null, [], 400);
            }
        } catch (\Exception $ex) {
            return  $this->mainResponse(false, $ex->getMessage(), null, [], $ex->getCode());
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'c_password' => 'required|string|min:6|same:password',
            'fcm_token' =>'required|string|max:255|unique:mobile_tokens,token',
            'device' =>'required|in:android,ios',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);

        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        // $input['image'] =  $this->saveImages('avatar.jpg', 'images/userImages/');
        $user = User::create($input);
        $reg_user = User::query()->find($user->id);

        // $user->setAttribute($user->createToken('ok')->accessToken);
        $reg_user['token'] =  $user->createToken('MyApp')->accessToken;
        MobileToken::query()->updateOrCreate(
            ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device],
            ['user_id' => $user->id, 'token' =>$request->fcm_token , 'device' => $request->device] );
        return  $this->mainResponse(true, __('messages.success'), $reg_user, [], 200);
    }

    public function logout(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $token = $request->user()->token()->revoke();
        return  $this->mainResponse(true, __('messages.logout'), null, [], 200);

    }
}
