@extends('layouts.IndexLayout')
@section('content')
<div class=" content-fixed content-auth">
   <div class="content">
      <div class="container ">
         <div class="media align-items-stretch justify-content-center ht-100p row">
            <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60 card col-lg-5">
               <div class="card-body wd-100p">
                  <form id="login_form" method="post" autocomplete="off">
                     <h4 class="tx-color-01 mg-b-5">Sign In Here</h4>
                     <p class="tx-color-03 tx-16 mg-b-10">Login for already Registered Candidates</p>
                     <div class="form-group mb-3">
                        <label>Enter Email-Id/Mobile  <span class="text-muted">ईमेल-आयडी/मोबाईल</span></label>
                        <input type="text" class="form-control" placeholder="Please Email-Id " name="username" id="email">
                     </div>
                     <div class="form-group mb-0 " id="PasswordField">
                        <label>Enter Password</label>
                        <input type="Password" class="form-control" name="password" id="password">
                        <div class="text-right otplogin" id="loginotp">Login with OTP ?</div>
                     </div>
                     <button class="btn btn-brand-02 btn-block w-150 m-auto" type="submit">Login</button>
                     <div class="tx-16 mg-t-20 tx-center">Dont have an account? <a href="{{route('register')}}"><b>Register Here</b></a></div>
                     <div class="tx-16 mg-t-20 tx-center">Forgot password? <a href="{{route('password.request')}}" target="_blank"><b>Click Here</b></a></div>
                  </form>
               </div>
            </div>
            <!-- sign-wrapper -->
            <div class="media-body d-lg-flex pos-relative col-lg-7 card pb-20">
               <div class="card card-body shadow-none bd-info mt-3 mb-3">
                  <div class="marker marker-ribbon marker-info pos-absolute t-10 l-0">Instructions सूचना </div>
                  <ul class="steps steps-vertical mt-4 stepsOverflow">
                   
                  </ul>
               </div>
            </div>
            <!-- media-body -->
         </div>
         <!-- media -->
      </div>
      <!-- container -->
   </div>
</div>
<div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-14">
         <div class="modal-header">
            <h6 class="modal-title" id="modalLabel">Modal Title</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="modalBody">
          <ul class="steps steps-vertical mt-4 stepsOverflow">
          </ul>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function loadModal(instructionId,modalTitle)
     {
       $('#instructionsModal').modal('hide');
       $('#modalLabel').html('');
       $('#modalBody').html('');
         $.ajaxSetup({
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
          $.ajax({
             url: "{{ route('loginInstructions') }}"+"/"+instructionId,
             type: "get",
             beforeSend: function () { 
               $('#loader').removeClass('hidden');
   
             },
             success:function(data) { 
               $(".body_overlay").hide();
               if(data.status)
               {
                 if(data.status=='success') 
                   {
                     $('#instructionsModal').modal('toggle');
                     $('#modalLabel').html(modalTitle);
                     $('#modalBody').html(data.data);
                   }else{
                     toastr.error(data.data);
                   }
               }
             },
             complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
               $('#loader').addClass('hidden');
             }
       });
     }
   $(document).ready(function () {
   if("{{Session::has('paymentSuccess')}}"){
       toastr.success("{{Session::get('paymentSuccess')}}");
   }else if("{{Session::has('paymentFail')}}"){
     toastr.error("{{Session::get('paymentFail')}}");
   }
     $("#login_form").validate({
       rules: {
           username: {required: true},
           password: {required: true},
         },
       messages: {
        username: {required: "Please enter Email id/Mobile."},
         password: {required: "Please enter password"},
     },
     submitHandler: function (form) {
       $.ajaxSetup({
                       headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                      });
                $.ajax({
                   url: "{{ route('login') }}",
                   type: "POST",
                   data :$(form).serialize(),
                   beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                     $('#loader').removeClass('hidden');
   
                   },
                   success:function(data) { 
                     $(".body_overlay").hide();
                     if (data.ValidatorErrors) {
                       $.each(data.ValidatorErrors, function(index, jsonObject) {
                         $.each(jsonObject, function(key, val) {
                             toastr.error(val);
                         });
                         return false;
                       });
                     }
                     if(data.status)
                     {
                       if(data.status=='success') 
                         {
                           $('#login_form')[0].reset();
                           window.location.replace("{{route('applicationstatus.index')}}");
                         }else{
                           toastr.error(data.data);
                          //  window.location.replace("{{route('login')}}");
                         }
                     }
                   },
                   error: function (data) { // Set our complete callback, adding the .hidden class and hiding the spinner.
                     toastr.error(data.message);
                   },
                   complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                     $('#loader').addClass('hidden');
                   }
             });
     }
   });
   });
     
</script>
@endsection