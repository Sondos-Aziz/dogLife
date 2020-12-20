
@extends('layouts.app')
@push('css')

@endpush


@section('content')
    <div id="content" class="main-content">
        <div class="row justify-content-md-center">
                <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{trans('general.add_app')}}</h4>
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
                        <form  method="post" action="{{route('about_app.store')}}" >
                            @csrf
                             @foreach(locales() as $key => $value)
                                 <div class="col-md-12">
                                    <div class="form-group bmd-label-floating">
                                        <label for="content_{{$key}}" class="control-label">{{trans('general.content')}}- @lang('common.'.$key) </label>
                                        <input type="text" id="content_{{$key}}"  class="form-control" name="content_{{ $key }}" >
                                    </div>
                                </div>
                            @endforeach

                          

                           

                            <a href="{{route('about_app.index')}}" class="btn btn-danger">{{trans('general.back')}}</a>
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


