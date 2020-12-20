@extends('layouts.app')

@section('content')
<div id="content" class="main-content">
    {{-- <div class="layout-px-spacing">

        <div class="page-header">

            <div class="d-flex justify-content-sm-end justify-content-center m-2">
                    class="btn btn-info btn-xs"><i class="material-icons">Send push to Users </i></a>

            </div>
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        </div>
--}}
            {{-- <div class="text-center">
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" 
                class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </div> --}}

                <div class="card">
                        <h3 class="card-header">@lang('general.send_notifications')</h3>

                        <div class="card-body">
                            <form  method="post" action="{{route('send-push')}}" >
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group bmd-label-floating">
                                        <label for="title" class="control-label">{{trans('general.title')}} </label>
                                        <input type="text" id="title"  class="form-control" name="title" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group bmd-label-floating">
                                        <label for="message" class="control-label">{{trans('general.content_msg')}} </label>
                                        <input type="text" id="message"  class="form-control" name="message" >
                                    </div>
                                </div>
                                <input class="btn btn-primary m-3" type="submit" value="@lang('general.Send')" >

                           
                            </form>
                        </div>
                   
                </div>
            </div>
        </div>
    </div> 

    {{-- <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>
    <script src ="https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js"> </script>
   
<script>
  
    var firebaseConfig = {
        apiKey: "AIzaSyDl1VHYiwK1cZJLv-_qS9J2bjAOm3HnHk4",
        authDomain: "doglife-e7de0.firebaseapp.com",
        projectId: "doglife-e7de0",
        storageBucket: "doglife-e7de0.appspot.com",
        messagingSenderId: "659823965436",
        appId: "1:659823965436:web:7dab5f7296773f023cd379",
        measurementId: "G-YPYJ9WYZ96"
    };
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script> --}}

@endsection