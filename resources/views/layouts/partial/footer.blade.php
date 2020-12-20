

@if(LaravelLocalization::getCurrentLocaleDirection() == 'ltr')


 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('assets/en/js/libs/jquery-3.1.1.min.js') }}"></script>
 <script src="{{ asset('assets/en/bootstrap/js/popper.min.js') }}"></script>
 <script src="{{ asset('assets/en/bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('assets/en/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/en/js/app.js') }}"></script>

 <script src="{{ asset('assets/en/js/custom.js') }}"></script>
 <!-- END GLOBAL MANDATORY SCRIPTS -->

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 <script src="{{ asset('assets/en/plugins/apex/apexcharts.min.js') }}"></script>
 <script src="{{ asset('assets/en/js/dashboard/dash_1.js') }}"></script>
 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

 <!-- END GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('assets/en/js/custom.js') }}"></script>
 <script src="{{ asset('assets/en/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
 {{-- <script src="assets/js/apps/contact.js"></script> --}}
 {{--<script type="text/javascript"  src="{{ asset('assets/en/js/apps/contact.js') }}" charset="utf-8" defer></script>--}}
 <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
 <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>


 <!-- BEGIN PAGE LEVEL SCRIPTS -->
 <script src="{{ asset('assets/en/plugins/table/datatable/datatables.js') }}"></script>
 <script>
     $('#zero-config').DataTable({
         "oLanguage": {
             "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
             "sInfo": "Showing page _PAGE_ of _PAGES_",
             "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
             "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
         },
         "stripeClasses": [],
         "lengthMenu": [7, 10, 20, 50],
         "pageLength": 7 
     });
 </script>

<script>
    $(document).ready(function() {
        App.init();
    });
</script>

@else

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/ar/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/ar/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/ar/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/ar/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/ar/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('assets/ar/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/ar/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/ar/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="{{ asset('assets/ar/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('assets/ar/plugins/table/datatable/datatables.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>


@endif

<script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>
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
// console.log(messaging);
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
                url: "{{url('/') . '/save_token/' }}" + token,
                type: 'POST',
                dataType: 'JSON',
                success: function (response) {
                    // alert('Token saved successfully.');
                },
                error: function (err) {
                    console.log('User Chat Token Error'+ err);
                },
            });

        }).catch(function (err) {
            console.log('User Chat Token Error'+ err);
        });
  
  
messaging.onMessage(function(payload) {
    const noteTitle = payload.notification.title;
    const noteOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };
    new Notification(noteTitle, noteOptions);
});

</script>
<script>
    $('#readMsg').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('notification_id');
        $.ajax({
            type: 'post',
            url: "{{ url('/read_notifications/') }}/" + id,    
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data == true) {
                    console.log('success');
                    // $('#success_msg').show();
                }
            }, error: function (reject) {
                console.log('error');
                // var response = $.parseJSON(reject.responseText);
                // $.each(response.errors, function (key, val) {
                //     $("#" + key + "_error").text(val[0]);
                // });
            }
        });
    });

  
      
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: "{{ route('get-notifications') }}" ,    
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
                      bodyData+='<a href="" id="readMsg" data-notification_id="'+ row.id+'">' +
			
                        " <div class='dropdown-item '>"+
                        '<div class="media">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>'
                   +' <div class="media-body">'+
                       ' <div class="notification-para">'+
                           ' <span class="user-name">'+ row.name +'</span>'+
                          '  @if('+row.type+' == 1)'
                           +" @lang('general.add_post')"
                        +'@endif'
                   + '</div>'
                       +'<div class="notification-meta-time">'+
                            row.created_at 
                        +' </div>'+
                  '  </div></div> <br></div></a>'
                });
                $("#bodyData").append(bodyData);
            
            }, error: function (reject) {
                console.log('error');
            }
        });
 
</script>


