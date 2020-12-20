<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\GeneralResponseTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use GeneralResponseTrait;
    //getPolicy 
    public function getPolicy()
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }
        
        $policy = Setting::where('type', 'policy')->first();
        return  $this->mainResponse(true, 'success', $policy, [], 200);
    }

    //getAboutApp
    public function getAboutApp()
    {
        if(auth('api')->check()==false){
            return $this->mainResponse(false,trans('messages.unauthorized') , [],[] ,404);
        }

        $app = Setting::where('type', 'app')->first();
        return  $this->mainResponse(true, 'success', $app, [], 200);
    }
}
