@extends('layouts.app')

@section('header')

@endsection


@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row" id="cancel-row">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="alert alert-success" id="success_msg" style="display: none;">
                    {{ trans('messages.deleteMsg') }}
                     </div>
                   

                    <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>{{trans('general.userName')}}</th> 
                                        <th>{{trans('general.title')}}</th> 
                                        <th>{{trans('general.content')}}</th>
                                        <th>{{trans('general.type')}}</th> 
                                        <th>{{trans('general.CreatedAt')}} </th>
                                        {{-- <th>{{trans('general.actions')}} </th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($admin_notifications as $notification)
                                        <tr >
                                            <td>{{ 1  }}</td>
                                            <td> {{  $notification->user->name}}  </td>
                                            <td>{{  $notification->title}} </td>
                                            <td>{{  $notification->content}} </td>
                                            <td>
                                                @if($notification->type == 1)
									        	@lang('general.add_post')
									            @endif
                                            </td>
                                            <td>{{ $notification->getCreatedAtAttribute($notification->created_at) }} </td>
                                         </tr>
                                    @endforeach
                               </tbody>
                      
                        </table>

                     
                    </div>
                </div>
            </div>

        </div>

    </div>
   

    <!--  END CONTENT AREA  -->
@endsection
