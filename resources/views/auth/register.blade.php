@extends('layouts.IndexLayout')
@section('content')
<div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p row">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60 card col-lg-7 mt-3">
            <div class="pd-t-20 wd-100p ">
              <h4 class="tx-color-01 mg-b-5">Registration Here</h4>
              <p class="tx-color-03 tx-12 mg-b-10">Candidate must have a valid and functional email id & Mobile number which will be used for further processes and official communication.
              </p>
              <form id="registration_form" method="POST" autocomplete="off">
              <div class="row">
              
                 <div class="col-lg-3">
                  <label>Salutation <br><span class="text-muted">अभिवादन</span></label>
                  <select class="form-control" name="salutation">
                    <option value="" selected>[ select ]</option>
                    <option value="MR">MR.</option>
                    <option value="MS">MS.</option>
                    <option value="MRS">MRS.</option>
                  </select>
                </div>
              <div class="col-lg-9 form-group">
               <label>Name as per SSC/ 10th Marksheet/ Certificate<br> <span class="text-muted">कृपया SSC/ 10वी मार्कशीट/ प्रमाणपत्रानुसार नाव टाका</span></label>
               <input type="text" class="form-control" placeholder="Please Enter Full Name" name="name" id="fullName">
              </div>
              
              <div class="form-group col-lg-7">
                <label>Mother Name<br> <span class="text-muted">आईचे नाव</span></label>
                <input type="text" class="form-control" placeholder="Please Enter Mother Name" name="mother_name" id="motherName"> 
              </div>


              <div class="form-group col-lg-5">
                <label>Date Of Birth<br> <span class="text-muted">जन्मतारीख</span></label>
                <input type="date" class="form-control" placeholder="Please Enter Date Of Birth" name="dob" id="dob"> 

              </div>
              <div class="col-lg-7 form-group">
                <label>Enter Mobile Number<br> <span class="text-muted">मोबाइल क्र. प्रविष्ट करा</span></label>
                <div class="m-auto row">
                  <div class="col-lg-8 pd-0 col-8">
                   <input type="text" class="form-control" placeholder="Please Enter Mobile Number" name="mobile" id="mobile" maxlength="10">
                  </div>
                  <div class="col-lg-4 pd-0 col-4">
                    <button class="btn btn-outline-dark w-100" type="button" id="sendOtpMobile" name="sendOtpMobile" onclick="sendOtp('mobile','mobile','encryptMobileOtp','sendOtpMobile','verifyOtpMobile')">Send OTP</button>
                  </div>
                </div>
              </div>
              <div class="form-group col-lg-5">
                <label>Enter OTP sent on mobile<br> <span class="text-muted">मोबाईल नंबरवर पाठवलेला ओटीपी प्रविष्ट करा</span></label>
                <div class="row m-auto">
                  <div class="col-lg-7 pd-0 col-7">
                    <input type="text" class="form-control" placeholder="Please Enter OTP" name="mobileOtp" id="mobileOtp">
                  </div> 
                  <div class="col-lg-5 pd-0 col-5">
                    <button class="btn btn-outline-dark w-100" type="button" id="verifyOtpMobile" name="verifyOtpMobile" disabled onclick="verifyOtp('mobileOtp','encryptMobileOtp','verifyOtpMobile','mobile','encryptMobileOtp')">Verify OTP</button>
                  </div>
                </div>
              </div>
              <div class="col-lg-7">
                <label>Enter Email-ID<br> <span class="text-muted">ईमेल-आयडी प्रविष्ट करा</span></label>
                 <div class="row m-auto">
                  <div class="col-lg-8 pd-0 col-8">
                  <input type="text" class="form-control" placeholder="Please Enter Email ID" name="email" id="email">
                </div>
                  <div class="col-lg-4 pd-0 col-4">
                    <button class="btn btn-outline-dark w-100" type="button" id="sendOtpEmail" onclick="sendOtp('email','email','encryptEmailOtp','sendOtpEmail','verifyOtpEmail')">Send OTP</button>
                  </div>
                </div>
              </div>
              <div class="form-group col-lg-5">
                <label>Enter OTP sent on Email-ID<br> <span class="text-muted">ईमेल-आयडीवर पाठविलेला ओटीपी प्रविष्ट करा</span></label>
                <div class="row m-auto">
                  <div class="col-lg-7 pd-0 col-7">
                    <input type="text" class="form-control" placeholder="Please Enter OTP" name="EmailOtp" id="EmailOtp">
                  </div>
                  <div class="col-lg-5 pd-0 col-5">
                    <button class="btn btn-outline-dark w-100" type="button" id="verifyOtpEmail" disabled onclick="verifyOtp('EmailOtp','encryptEmailOtp','verifyOtpEmail','email','encryptEmailOtp')">Verify OTP</button>
                  </div>
                </div>
              </div>
              <div class="form-group col-lg-12 mt-3">
            <button type="submit" class="btn btn-brand-02 btn-block wd-150 m-auto" >Create Account</button>
          </div>
            </div>
             
            <input type="hidden" name="encryptMobileOtp" id="encryptMobileOtp">
            <input type="hidden" name="encryptEmailOtp" id="encryptEmailOtp">
          </form>
              <!-- <button class="btn btn-brand-02 btn-block">Create Account</button> -->
              <div class="tx-16 mg-t-10 tx-center">Already have an account? <a href="{{route('login')}}"><b>Sign In</b></a></div>
            </div>
          </div><!-- sign-wrapper -->
         
        </div><!-- media -->
      </div><!-- container -->
    </div>
    <script type="text/javascript">
  $(document).ready(function () {
    $("#registration_form").validate({
      rules: {
        salutation: {required: true},
        name: {required: true},
        mother_name: {required: true},
        dob: {required: true,date: true},
        mobile: {required: true,number: true,minlength: 10,maxlength: 10},
        mobileOtp: {required: true,number: true,minlength: 6,maxlength: 6},
        // email: {required: true,email: true},
        // EmailOtp: {required: true,number: true,minlength: 6,maxlength: 6},
        },
      messages: {
        salutation: {required: "Please select salutation"},
        name: {required: "Please enter name"},
        dob: {required: "Please enter dob",date: "Please enter valid dob"},
        mobile: {required: "Please Enter Mobile Number",number: "Please enter valid number",minlength: "Please enter valid number",maxlength: "Please enter valid number"},
        mobileOtp: {required: "Please Enter OTP",number: "Please enter valid otp",minlength: "Please enter valid otp",maxlength: "Please enter valid otp"},
        email: {required: "Please Enter email id",email: "Please enter valid email id"},
        EmailOtp: {required: "Please Enter OTP",number: "Please enter valid otp",minlength: "Please enter valid otp",maxlength: "Please enter valid otp"},
    },
    submitHandler: function (form) {
      $.ajaxSetup({
                      headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                     });
               $.ajax({
                  url: "{{ route('register') }}",
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
                          $('#registration_form')[0].reset();
                          toastr.success('Registration successful.Login details has been sent your registred email and mobile');
                          setTimeout(function() {
                            window.location.replace("{{route('login')}}");
                          }, 2000);
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
function sendOtp(inputType,selfId,otpPutId,sendBtnId,verifyBtnId)
    {
      var input=$('#'+selfId).val();
      var validationRule='';
      if(input=='') { toastr.error('Please enter valid '+inputType); return false;}
      if(inputType=='mobile') validationRule=/\b\d{10}\b/ ; else  validationRule=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!validationRule.test(input)){ toastr.error('Please enter valid '+inputType); return false;}
         $(".body_overlay").show();
         $.ajaxSetup({
                      headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                     });
               $.ajax({
                  url: "{{ route('otp.send') }}",
                  type: "post",
                  data :{input:input},
                  beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden');

                  },
                  success:function(data) { 
                    $(".body_overlay").hide();
                    if(data.status)
                    {
                      if(data.status=='success') 
                        {
                          $('#'+otpPutId).val(data.data);
                          $('#'+selfId).attr('readonly',true);
                          $('#'+sendBtnId).attr('disabled',true);
                          $('#'+verifyBtnId).attr('disabled',false);
                          toastr.success('otp sent successfully');
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
  function verifyOtp(selfId,otpId,verifyBtnId,inputId,otpPutId){
    var enteredOtp=$('#'+selfId).val();
      var sentOtp=$('#'+otpId).val();
        if(enteredOtp.length !='6'){ toastr.error('Please enter valid otp'); return false;}
         $(".body_overlay").show();
         $.ajaxSetup({
                      headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                     });
               $.ajax({
                  url: "{{ route('otp.verify') }}",
                  type: "post",
                  data :{sentOtp:sentOtp,enteredOtp:enteredOtp,input:$('#'+inputId).val()},
                  beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden');

                  },
                  success:function(data) { 
                    $(".body_overlay").hide();
                    if(data.status)
                    {
                      if(data.status=='success') 
                        {
                          $('#'+selfId).attr('readonly',true);
                          $('#'+verifyBtnId).attr('disabled',true);
                          $('#'+otpPutId).val(data.data);
                          toastr.success('Otp Verification Successful');
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
</script>
@endsection


