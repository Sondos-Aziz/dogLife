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
                                        <th>{{trans('general.actions')}} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($admin_notifications as $notification)
                                        <tr >
                                            <td>{{ 1  }}</td>
                                            <td> {{  $notification->name}}  </td>
                                            <td>{{  $notification->title}} </td>
                                            <td>{{  $notification->content}} </td>
                                            <td>
                                                @if($notification->type == 1)
									        	@lang('general.add_post')
									            @endif
                                            </td>
                                            <td>{{ $notification->getCreatedAtAttribute($notification->created_at) }} </td>
                                       <td>
                                            <button type="button" id ="readMsg" class="btn btn-info btn-sm" data-notification_id='{{$notification->id}}' >
                                                <i class="material-icons">done</i>
                                            </button>
                                       </td>


                                        </tr>
                                    @endforeach
                               </tbody>
                      
                        </table>

                     
                    </div>
                </div>
            </div>

        </div>

    </div>
   
    @section('script')
        <script>
        
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: "{{ route('unreadNotifications') }}" ,    
            processData: false,
            contentType: false,
            cache: false,
            success: function(dataResult){
                console.log(dataResult);
                var resultData = dataResult.data;
                var bodyData = '';              
                    var i=1;
                $.each(resultData,function(index,row){
                    // console.log(row.id);
                    // alert(row.id);
                    // alert(row.name);
                    bodyData+=" <tr >"+" <td>{{ 1  }}</td>"+" <td>"+ row.name +"</td>"+
                        <td>"+ row.title +"</td>"+ <td>"+ row.content +"</td>"+
                         "<td>"+ row.name +"</td>"+
                       " <td>"+"
                            @if("+row.type + " == 1)"+
                          "  @lang('general.add_post')"+
                           " @endif"
                          +"</td>" +
                       " <td>"+ row.created_at +"</td>"+
                      "<td>"+
                       '<button type="button" id ="readMsg" class="btn btn-info btn-sm" data-notification_id="'+row.id+ "'>" +
                          '<i class="material-icons">done</i>'+"</button>"
                      " </td>"+
                      "</tr>"
                      
                });
                $("#bodyData").append(bodyData);
            
            }, error: function (reject) {
                console.log('error');
            }
        });
        </script>  
    @endsection
            

    <!--  END CONTENT AREA  -->
@stop
