<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\News;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allNews = News::paginate(15);
       $locale = App::getLocale();
       return view('admin.news.index',compact('allNews','locale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::all();
        return view('admin.news.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            // 'user_id' => 'required',
            'uploadedFile' => 'mimes:peg,png,jpeg,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',

        ];
        foreach (locales() as $key => $value) {
            $rules['title_' . $key] = 'required|string|max:255';
            $rules['description_' . $key] = 'string|max:255';

        }
        $this->validate($request, $rules);

        // $image = $this->saveImages($request->uploadedFile,'images/newsMedia/');
        $imageExtensions = ["jpg" , "jpeg","peg", "png","gif","svg" ];
        // $explodeImage = explode('.', $request->uploadedFile);
        // $extension = end($explodeImage);
        $extension =  $request->uploadedFile->extension();
        $type = '';
        if(in_array($extension, $imageExtensions))
        {
            $type = 'image';
        }else
             $type = 'video';

        $image = null; $video = null;
        if( $request->hasFile('uploadedFile') && $type == 'image') {
            $image = $this->saveImages($request->uploadedFile,'images/newsImages/');
        }elseif( $request->hasFile('uploadedFile') && $type == 'video') {
            $video = $this->saveImages($request->uploadedFile,'videos/');
        }
        $data = [
            'owner_id' => Auth()->user()->id,
            'image' => $image,
            'video' => $video,
            'type' => 'admin',
        ];
        foreach (locales() as $key => $value) {
            $data[$key] = ['title' => $request->get('title_' . $key),
                'description' => $request->get('description_' . $key)];
        }

        News::query()->create($data);

        return redirect()->route('news.index')->with('successMsg', trans('messages.save'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news= News::find($id);
        return view('admin/news/show',compact('news'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        // $users = User::all();

        return view('admin.news.edit',compact('news'));
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
        $news = News::query()->find($id);
        $rules = [
            // 'user_id' => 'required',
            'uploadedFile' => 'mimes:peg,png,jpeg,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
        ];
        foreach (locales() as $key => $value) {
            $rules['title_' . $key] = 'required|string|max:255';
            $rules['description_' . $key] = 'string|max:255';
        }

        $this->validate($request, $rules);

        $oldImage = "images/newsImages/".$news->image; 
        $oldVideo = "videos/".$news->video; 
        if(File::exists($oldImage)) {
            File::delete($oldImage);
        }if(File::exists($oldVideo)){
            File::delete($oldVideo);
        }
        $imageExtensions = ["jpg" , "jpeg","peg", "png","gif","svg" ];
        // $explodeImage = explode('.', $request->uploadedFile);
        // $extension = end($explodeImage);
        $extension =  $request->uploadedFile->extension();
        $type = '';
        if(in_array($extension, $imageExtensions))
        {
            $type = 'image';
        }else
             $type = 'video';
        $image = null; $video = null;
        if( $request->hasFile('uploadedFile') && $type == 'image') {
            $image = $this->saveImages($request->uploadedFile,'images/newsImages/');
        }elseif( $request->hasFile('uploadedFile') && $type == 'video') {
            $video = $this->saveImages($request->uploadedFile,'videos/');
        }
        $data = [
            // 'owner_id' => Auth()->user()->id,
            'image' => $image,
            'video' => $video,
        ];
        foreach (locales() as $key => $value) {
            $data[$key] = ['title' => $request->get('title_' . $key),
                'description' => $request->get('description_' . $key)];
        }

        $news->update($data);

        return redirect()->route('news.index')->with('successMsg', trans('messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::query()->find($id)->delete();
        return redirect(route('news.index'));
    }
}
