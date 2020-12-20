
@extends('layouts.app')
@push('css')

@endpush


@section('content')
    <div id="content" class="main-content">
        <div class="row justify-content-md-center">
                <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{trans('general.Add News')}}</h4>
                    </div>
                   
                    @if (count($errors) > 0)
                    <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="card-body">
                        <form  method="post" action="{{route('news.store')}}" enctype="multipart/form-data">
                            @csrf
                             @foreach(locales() as $key => $value)
                                 <div class="col-md-12">
                                    <div class="form-group bmd-label-floating">
                                        <label for="title_{{$key}}" class="control-label">{{trans('general.title')}}- @lang('common.'.$key) </label>
                                        <input type="text" id="title_{{$key}}"  class="form-control" name="title_{{ $key }}" >
                                    </div>
                                </div>
                            @endforeach

                            @foreach(locales() as $key => $value)
                                <div class="col-md-12">
                                    <div class="form-group bmd-label-floating">
                                        <label for="description_{{$key}}" class="control-label">{{trans('general.description')}}- @lang('common.'.$key) </label>
                                        <input type="text" id="description_{{$key}}"  class="form-control" name="description_{{ $key }}" >
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12">
                            <div class="form-group bmd-label-floating">
                                <label for="media">@lang('general.media')</label>
                                <input type="file" class="form-control" name="uploadedFile" id="uploadedFile" >
                            </div>
                            </div>

                            {{-- <div class="col-md-12">
                                <div class="form-group bmd-label-floating">
                                    <label class="control-label">@lang('general.userName')</label>

                                    <select class="form-control" name="user_id">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div> --}}

                            <a href="{{route('news.index')}}" class="btn btn-danger">{{trans('general.back')}}</a>
                            <button type="submit" class="btn btn-primary">{{trans('general.save')}}</button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection

@push('scripts')

@endpush


