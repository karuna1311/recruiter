@extends('layouts.IndexLayout')
@section('content')
<div class=" content-fixed content-auth">
   <div class="content">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><b>{{ __('Forgot Password') }} ?</b></div>
                <div class="card-body">
                    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                          <label>Enter Mobile Number / Email-Id </label>
                            <div>
                                <input id="username" type="text" class="form-control" name="username" required autofocus placeholder="Please enter registered Mobile No/ Email-Id ">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Enter Date Of Birth</label>
                            <div >
                                <input id="dob" type="date" class="form-control" name="dob"  required autocomplete="email" autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">

$(document).ready(function () {
     $("#forgotPasswordForm").validate({
       rules: {
           username: {required: true},
           dob: {required: true,date: true},
         },
       messages: {
        username: {required: "Please enter mobile/email id."},
        dob: {required: "Please enter Date Of Birth",date: "Please enter valid Date Of Birth"},
     },
     submitHandler: function (form) {
       $.ajaxSetup({
                       headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                      });
                $.ajax({
                   url: "{{ route('password.update') }}",
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
                           $('#forgotPasswordForm')[0].reset();
                           toastr.success(data.data);
                           window.location.replace("{{route('login')}}");
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
   });
   });
</script>
@endsection
