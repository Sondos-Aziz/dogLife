@extends('layouts.app')


@section('header')

@endsection


@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="page-header">

                <div class="d-flex justify-content-sm-end justify-content-center m-2">
                    <a href="{{ route('news.create' )}}"
                        class="btn btn-info btn-xs"><i class="material-icons">add </i></a>


                </div>
            </div>

            <div class="row" id="cancel-row">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="alert alert-success" id="success_msg" style="display: none;">
                    {{ trans('messages.deleteMsg') }}
                        </div>
                    {{-- @include('flash::message')

                    @if(session('successMsg'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('successMsg')}}</span>
                        </div>
                    @endif --}}

                    <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>{{trans('general.title')}}</th>
                                        <th>{{trans('general.description')}}</th>
                                        {{-- <th>{{trans('general.userName')}}</th> --}}
                                        {{-- <th>{{trans('general.bonesNo')}}</th>
                                        <th>{{trans('general.snapsNo')}}</th> --}}
                                        <th>{{trans('general.CreatedAt')}} </th>
                                        <th>{{trans('general.actions')}} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($allNews as $news)

                                        <tr class="countryRow{{ $news->id }}">

                                            <td>{{ $loop->index +1  }}</td>
                                            <td>{{ $news->title }}</td>
                                            <td>
                                             {{substr( $news->description, 0, 100)}}
                                           </td>
                                            {{-- <td>{{$news->user->name}}</td> --}}
                                            {{-- <td>{{$news->bones}}</td>
                                            <td>{{$news->snaps}}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($news->created_at)->format('g:i A') }}  </td>

                                            <td>
                                                <div class="action-btn">

                                                     <a href="{{ url( $locale .'/news/'. $news->id .'/edit' )}}" id="btn-edit"
                                                       class="btn btn-info btn-xs"><i class="material-icons">edit</i></a>
                                                   
                                                       <a href="{{ route('news.show',$news->id)}}"
                                                        class="btn btn-primary btn-sm"><i class="material-icons">details </i></a>
                                                   
                                                        <button class="btn btn-danger btn-flat btn-sm remove-user" type="submit"
                                                            onclick="deleteConfirmation({{$news->id}})"> <i class="material-icons">
                                                           delete </i></button>

                                                     <form
                                                        id="delete-form-{{ $news->id }}" action="{{ route('news.destroy', $news->id) }}" class="delete_btn"
                                                        style="display: none;" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                     </form>

                                                </div>
                                            </td>



                                         </tr>
                                    @endforeach


                               </tbody>
                        {{-- <tfoot>
                        <tr>
                            <th># </th>
                            <th>{{trans('general.title')}}</th>
                            <th>{{trans('general.description')}}</th>
                            <th>{{trans('general.userName')}}</th>
                            <th>{{trans('general.bonesNo')}}</th>
                            <th>{{trans('general.snapsNo')}}</th>
                            <th>{{trans('general.CreatedAt')}} </th>
                            <th>{{trans('general.actions')}} </th>
                        </tr>
                        </tfoot> --}}
                        </table>

                     
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>

    <!--  END CONTENT AREA  -->
@endsection

@section('scripts')
    {{-- <script>
        $(document).on('click', '#delete_btn', function(e) {
            e.preventDefault();
            var news_id = $(this).attr('news_id');
            $.ajax({
                type: 'delete',
                url: "{{ url('news') }}" + "/" + news_id,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': news_id

                    // this id is exists in the data in the controller response
                },
                success: function(data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                    $('.countryRow' + data.id).remove();
                },
                error: function(reject) {}
            });
        });

    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>

        function deleteConfirmation(id) {
            Swal.fire({
                title: "Delete?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then((result) => {
                if (result.value){
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                }
            });

    }
    </script>
@stop
