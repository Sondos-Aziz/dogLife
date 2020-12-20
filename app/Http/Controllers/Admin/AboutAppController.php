<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class AboutAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = Setting::where('type', 'app')->first();
        $locale = App::getLocale();
        return view('admin.setting.app.index', compact('app', 'locale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.app.create');
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
            'type' => 'app',
        ];
        foreach (locales() as $key => $value) {
            $data[$key] = ['content' => $request->get('content_' . $key)];
        }
        Setting::query()->create($data);

        return redirect()->route('about_app.index')->with('successMsg', trans('messages.save'));
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
        $app = Setting::find($id);
        return view('admin.setting.app.edit', compact('app'));
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
        $app = Setting::query()->find($id);
        foreach (locales() as $key => $value) {
            $rules['content_' . $key] = 'required|string';
        }
        $this->validate($request, $rules);

        $data = [];
        foreach (locales() as $key => $value) {
            $data[$key] = ['content' => $request->get('content_' . $key)];
        }
        $app->update($data);

        return redirect()->route('about_app.index')->with('successMsg', trans('messages.updated'));
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
        return redirect(route('about_app.index'));
    }
}
