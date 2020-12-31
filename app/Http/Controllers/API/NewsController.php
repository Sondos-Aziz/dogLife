<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use App\Models\Bone;
use App\Models\News;
use App\Models\Snap;
use App\Models\Admin;
use App\Traits\ImageTrait;
use App\Models\MobileToken;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use App\Traits\GeneralResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    use GeneralResponseTrait;
    use ImageTrait;

    public function getAllNews()
    {
        // if(auth('api')->check()==false){
        //     return $this->mainResponse(false,trans('messages.unauthorized') ,[],[] ,404);
        // }
        $news = News::where('type', 'admin')->paginate(7);
        $allNews = $news->makeHidden(['user_name', 'user_image','snaps_count','bones_count','created_at']);
        $news->allNews=$allNews;
        return  $this->mainResponse(true,  __('messages.success'), $news, [], 200);
    }

    public function getAllUsersNews()
    { 
        if(auth('api')->check()==false){
        return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
    }
        $news = News::where('type', 'user')->where('owner_id',auth('api')->user()->id)->paginate(7);
      $allNews = $news->makeVisible(['snaps_count','user_info','bones_count'])->makeHidden(['title']);
      $news->allNews=$allNews;
        return  $this->mainResponse(true, __('messages.success'), $news, [], 200);
    }

    public function details($id)
    {
        // if(auth('api')->check()==false){
        //     return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        // }
        $news = News::where('type', 'user')->find($id)->makeHidden(['user_name', 'user_image','snaps_count','created_at']);
        if(!$news){
        return  $this->mainResponse(false,  __('messages.nothing'), [], [], 100);
        }
        return  $this->mainResponse(true,  __('messages.success'), $news, [], 200);
    }

    //add news
    public function store(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $rules = [
            // 'user_id' => 'required',
            'uploadedFile' => 'mimes:peg,png,jpeg,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'news_title' => 'required|string|max:255',
            'description' => 'string|max:255',
            'title' =>'required|string',
            'message' => 'required|string',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);
        }
        $imageExtensions = ["jpg", "jpeg", "peg", "png", "gif", "svg"];
        $extension =  $request->uploadedFile->extension();
        $type = '';
        if (in_array($extension, $imageExtensions)) {
            $type = 'image';
        } else
            $type = 'video';

        $image = null;
        $video = null;
        if ($request->hasFile('uploadedFile') && $type == 'image') {
            $image = $this->saveImages($request->uploadedFile, 'images/newsImages/');
        } elseif ($request->hasFile('uploadedFile') && $type == 'video') {
            $video = $this->saveImages($request->uploadedFile, 'videos/');
        }
        $data = [
            'owner_id' => auth('api')->user()->id,
            'image' => $image,
            'video' => $video,
            'title' => $request->news_title,
            'description' => $request->description,
            'type' => 'user',
        ];

         News::query()->create($data);
        //  $notifications_id = Notification::query()->get()->pluck('id');
         $users = User::query()->get()->pluck('id');
         $users_tokens = MobileToken::query()->whereIn('user_id', $users)->get();
         foreach($users_tokens as $user){
             if($user->user_id != auth('api')->user()->id){
            $dataNotification =[
                'user_id' => $user->user_id,
                'title' =>  $request->title,
                'content' =>  $request->message,
                'body' =>  $request->message,
                'type' =>1, // add news
                ];
                $notification = Notification::query()->create($dataNotification);
       
            }
        }
            $admin = Admin::first();
            // if(auth('web')->guard('admin')){
                $dataAdminNotification =[
                    'user_id' =>auth('api')->user()->id,
                    'admin_id' => $admin->id,
                    'title' =>  $request->title,
                    'content' =>  $request->message,
                    'body' =>  $request->message,
                    'type' =>1,  // add post
                    ];
                    $admin_notification = AdminNotification::query()->create($dataAdminNotification);
            //  }
       
        
         
         $android_users = MobileToken::query()->where('device', 'android')->whereIn('user_id', $users)->pluck('token')->toArray();
         $ios_users = MobileToken::query()->where('device', 'ios')->whereIn('user_id', $users)->pluck('token')->toArray();
 
         fcmNotification($android_users, $notification->id, $request->title, $request->message, $request->message, 1, 'android');
         fcmNotification($ios_users, $notification->id, $request->title, $request->message, $request->message, 1, 'ios');

         notificationForAdmin( $admin_notification->id, $request->title, $request->message, $request->message, 1);

         
        return  $this->mainResponse(true,  __('messages.success'), [], [], 200);
    }

    // add snap(comment)
    public function storeSnap(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $rules = [
            'comment' => 'string|required',
            'title' =>'required|string',
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);
        }
        $data = [

            'user_id' => auth('api')->user()->id,
            'comment' => $request->comment,
            'news_id' => $request->news_id,
        ];
       
       $snap = Snap::create($data);
    $owner_id = $snap->news->owner_id;
    //   $news = News::where('id', $snap->news_id)->first();
        $dataNotification =[
            'user_id' =>  $owner_id,
            'title' =>  $request->title,
            'content' =>  $request->message,
            'body' =>  $request->message,
            'type' =>2,
            ];
           $notification = Notification::query()->create($dataNotification);
            $android_users = MobileToken::query()->where('device', 'android')->where('user_id',  $owner_id)->pluck('token')->toArray();
           $ios_users = MobileToken::query()->where('device', 'ios')->where('user_id', $owner_id)->pluck('token')->toArray();
   
           fcmNotification($android_users, $notification->id, $request->title, $request->message, $request->message, 2, 'android');
           fcmNotification($ios_users, $notification->id, $request->title, $request->message, $request->message, 2, 'ios');
   
        return  $this->mainResponse(true,  __('messages.success'), [], [], 200);
    }


    // do like News
    public function likeNews(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $rules = [
            'news_id' => 'required',
            'title' =>'required|string',
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);
        }

        $bone = Bone::query()->where('user_id', auth('api')->user()->id)->where('news_id', $request->news_id)->exists();
        if($bone){
            Bone::query()->where('user_id', auth('api')->user()->id)->where('news_id', $request->news_id)->delete();
        }else{
            $data = [
                'user_id' => auth('api')->user()->id,
                'news_id' => $request->news_id,
            ];
    
             $bone = Bone::query()->create($data);
            //  $news = News::where('id', $bone->news_id)->first();
             $owner_id = $bone->news->owner_id;
             $dataNotification =[
                'user_id' => $owner_id,
                'title' =>  $request->title,
                'content' =>  $request->message,
                'body' =>  $request->message,
                'type' =>3,
                ];
               $notification = Notification::query()->create($dataNotification);
                $android_users = MobileToken::query()->where('device', 'android')->where('user_id', $owner_id)->pluck('token')->toArray();
               $ios_users = MobileToken::query()->where('device', 'ios')->where('user_id', $owner_id)->pluck('token')->toArray();
       
               fcmNotification($android_users, $notification->id, $request->title, $request->message, $request->message, 3, 'android');
               fcmNotification($ios_users, $notification->id, $request->title, $request->message, $request->message, 3, 'ios');
       
        }
         return  $this->mainResponse(true,  __('messages.success'), [], [], 200);
        // $news = News::find($request->news_id)->first();
        // $bones = $news->bones + 1; 
        // $bones_count = News::getBonesCountAttribute();
        // $data2 =[
        //     'bones' =>  $bones_count 
        // ];
        // News::updated($data2);
    }
}
