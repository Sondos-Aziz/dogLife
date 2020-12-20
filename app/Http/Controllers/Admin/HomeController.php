<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        // $admin_notifications = AdminNotification::all();
        return view('admin.dashboard');
    }

    public  function getNotifications(){
        $admin_notifications = AdminNotification::take(6)->where('seen',0)->get();
        // dd($admin_notifications->name);
        return  response()->json(['data' => $admin_notifications]);      
        // return json_encode(array('data'=>$admin_notifications));
    }

    //all unread notifications
    public function allUnreadNotifications(){
        $admin_notifications = AdminNotification::where('seen',0)->get();
        return view('admin.notification.getUnreadNotifications',compact('admin_notifications'));
    }

     // read notifications
     public function readNotifications($id){
        $admin_notifications = AdminNotification::query()->find($id);
       $admin_notifications->update(['seen' => 1]);
        return response()->json(['data' => true]);
    }
    
}
