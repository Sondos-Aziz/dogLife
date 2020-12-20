@extends('layouts.app')


@section('header')

@endsection


@section('content')

<div id="content" class="main-content">
    <div class="row justify-content-md-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header card-header-primary">

                    @if (session('successMsg'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('successMsg') }}</span>
                        </div>
                    @endif

                  
                </div>
            </div>

            <div class="card-body">
              
                
                    <h4> <strong>{{trans('general.title')}}: </strong>
                    <span class="text">{{$news->title}}</span></h4>
                   
                    <h4> <strong>{{trans('general.description')}}: </strong>
                    <span class="text">{{$news->description}}</span></h4>
                   
                    {{-- <h4> <strong>{{trans('general.userName')}}: </strong>
                    <span class="text">{{$news->user->name}}</span></h4>
                    --}}
                    {{-- <h4> <strong>{{trans('general.bonesNo')}}: </strong>
                    <span class="text">{{$news->bones}}</span></h4>
                        
                    <h4> <strong>{{trans('general.snapsNo')}}: </strong>
                    <span class="text">{{$news->snaps}}</span></h4> --}}

               <div >
                    @if($news->image)
                <img src="{{ $news->image }}" width="200px" height="200px" alt=" "  /> 
               @elseif($news->video)
              </div>
                {{-- <div  class="embed-responsive embed-responsive-4by3"  style="text-align: center; width:400px;height:400px" >
                    <video  class="embed-responsive-item"  controls>
                    <source src="{{ $news->video }}" type="video">
                    </video>
                </div> --}}
                <div class="embed-responsive embed-responsive-4by3"  style=" width:400px;height:400px">
                    <iframe  class="embed-responsive-item" src="{{ $news->video }}"></iframe>
                  </div>
                  
                @endif

                <div><a href="{{route('news.index')}}" class="btn btn-danger m-auto text-center">{{trans('general.back')}}</a>
                </div>
            </div>
    @stop