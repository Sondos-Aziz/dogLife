@extends('layouts.app')


@section('header')

@endsection


@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing"> 
                <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>{{trans('general.userName')}}</th>
                                        <th>{{trans('general.email')}}</th>
                                        <th>{{trans('general.message')}}</th>
                                        <th>{{trans('general.actions')}} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($contacts as $contact)

                                        <tr>

                                            <td>{{ $loop->index +1  }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->message}}</td>
                                            <td>
                                                <div class="action-btn">
                                                    <button class="btn btn-danger btn-flat btn-sm remove-user" type="submit"
                                                            onclick="deleteConfirmation({{$contact->id}})"> <i class="material-icons">
                                                           delete </i></button>

                                                     <form
                                                        id="delete-form-{{ $contact->id }}" action="{{ route('contacts.destroy', $contact->id) }}" class="delete_btn"
                                                        style="display: none;" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                     </form>

                                                </div>
                                            </td>
                                         </tr>
                                    @endforeach


                               </tbody>
                        <tfoot>
                            <tr>
                                <th># </th>
                                <th>{{trans('general.name')}}</th>
                                <th>{{trans('general.phone')}}</th>
                                <th>{{trans('general.email')}}</th>
                                <th>{{trans('general.massage')}}</th>
                                <th>{{trans('general.actions')}} </th>
                            </tr>
                        </tfoot>
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
