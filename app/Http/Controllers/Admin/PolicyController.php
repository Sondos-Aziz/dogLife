<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $policy = Setting::where('type','policy')->first();
      $locale = App::getLocale();
      return view('admin.setting.policy.index',compact('policy','locale'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.policy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach (locales() as $key => $value) {
            $rules['content_' . $key] = 'required|string';
        }
        $this->validate($request, $rules);
       
        $data = [
            'type' =>'policy',
         ];
        foreach (locales() as $key => $value) {
            $data[$key] = ['content' => $request->get('content_' . $key)];
        }

        Setting::query()->create($data);

        return redirect()->route('policies.index')->with('successMsg', trans('messages.save'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $policy = Setting::find($id);
        return view('admin.setting.policy.edit',compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $policy = Setting::query()->find($id);
        foreach (locales() as $key => $value) {
            $rules['content_' . $key] = 'required|string';
        }
        $this->validate($request, $rules);

        $data =[];
        foreach (locales() as $key => $value) {
            $data[$key] = ['content' => $request->get('content_' . $key)];
        }
        // dd($data);
        $policy->update($data);

        return redirect()->route('policies.index')->with('successMsg', trans('messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setting::query()->find($id)->delete();
        return redirect(route('policies.index'));
    }
}
