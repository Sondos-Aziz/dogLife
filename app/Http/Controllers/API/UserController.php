<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\News;
use App\Models\Contact;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Snap;
use App\Traits\GeneralResponseTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use GeneralResponseTrait;
    use ImageTrait;

    // update user profile
    public function updateUser(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $user = User::query()->find(auth('api')->user()->id);
        $rules = [
            'name' => 'nullable',
            'email' => 'email|unique:users,email,'.$user->id,
            'mobile' => 'nullable|between:8,14',
            'image' => 'nullable|image|mimes:peg,png,jpeg,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);
        }
        $oldImage = "images/userImages/" . $user->image;
        if (File::exists($oldImage)) {
            File::delete($oldImage);
        }
        $data = $request->except('image');
        // $image = null;
        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImages($request->image, 'images/userImages/');
        }
        // $data = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'mobile' => $request->mobile,
        //     'image' => $image,
        // ];
        $user->update($data);
        return  $this->mainResponse(true, trans('messages.updated'), [], [], 200);
    }

    //change password for user
    public function changePassword(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $user = User::find(auth('api')->user()->id);
        $rules = [
            'old_password' => ['required', new MatchOldPassword],
            // 'old_password' => 'required|hash_check:'. @$old_pass->password ,
            'new_password' => 'required|string|min:6',
            'c_password' => 'required|string|min:6|same:new_password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages(),101);
        }
        $data = [
            'password' => Hash::make($request->new_password),
        ];

        $user->update($data);
        return  $this->mainResponse(true, trans('messages.change_password'), [], [], 200);
    }


    // add contact message
    public function storeContact(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), null, $validator->errors(), 101);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
        Contact::query()->create($data);

        return $this->mainResponse(true, trans('messages.contact'), [], [], 200);
    }


    //search for news depends on title
    public function search(Request $request)
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        $rules = [
            'title' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->mainResponse(false, $validator->errors()->first(), null, $validator->errors(), 101);
        }

        $news  = News::query()->leftjoin('news_translations', 'news.id', '=', 'news_translations.news_id')
            ->select('news.*', 'news_translations.title')
            ->where('title', 'LIKE', '%' . $request->title . '%')->get()->makeHidden(['title']);

        //another solution
        // $news = News::query()->join('news_translations as t', function ($join) {
        //         $join->on('t.news_id', '=', 'news.id');
        //     })->select('news.*')->where('title', 'LIKE', '%' .$request->title. '%')->get()->makeHidden(['title']);    
        //     ;

        return $this->mainResponse(true, trans('messages.search'), $news, [], 200);
    }


    //get user Notifications
    public function getNotifications(){
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }

        $notifications = Notification::where('user_id',auth('api')->user()->id)->orderBy('id', 'desc')->get();
        return $this->mainResponse(true, trans('messages.notifications'), $notifications, [], 200);

    }

    //get the like post for user
    public function getLikePosts(){
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }

        $likes = Snap::where('user_id',auth('api')->user()->id)->orderBy('id', 'desc')->get();
        if($likes != null)
        return $this->mainResponse(true, trans('messages.notifications'), $likes, [], 200);
        else
        return $this->mainResponse(true, trans('messages.nothing'), $likes, [], 200);

    }
}
