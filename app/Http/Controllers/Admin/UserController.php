<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Admin;
use App\Models\MobileToken;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $serverKey;
 
    public function __construct()
    {
        $this->serverKey = config('app.firebase_server_key');
    }

    public function getNotifications(){
    //    $users = User::all();
        return view('admin.notification.sendNotification');
    }

    public function sendPush (Request $request)
    {
        $users = User::query()->get()->pluck('id');
        $users_tokens = MobileToken::query()->whereIn('user_id', $users)->get();
        foreach($users_tokens as $user){
           $dataNotification =[
               'user_id' => $user->user_id,
               'title' =>  $request->title,
               'content' =>  $request->message,
               'body' =>  $request->message,
               'type' =>4,  // add type from admin
               ];
               $notification = Notification::query()->create($dataNotification);
           }
        $android_users = MobileToken::query()->where('device', 'android')->whereIn('user_id', $users)->pluck('token')->toArray();
        $ios_users = MobileToken::query()->where('device', 'ios')->whereIn('user_id', $users)->pluck('token')->toArray();

        fcmNotification($android_users, $notification->id, $request->title, $request->message, $request->message, 4, 'android');
        fcmNotification($ios_users, $notification->id, $request->title, $request->message, $request->message, 4, 'ios');



        return redirect()->back()->with('message', trans('messages.notificationAdmin')); 
    }


     // saveToken // to send notifications from api to admin
    public function saveToken($token)
    {
        // dd('hi');
        $admin = Admin::query()->find(auth('admin')->id());
        $admin->token =$token;
        $admin->update();
        return response()->json([ trans('messages.token_saved')]);
    }

}
