@extends('layouts.UserDashboard')
@section('content')
 <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title">Session Application</h4>
        </div>
     </div>
     <div class="col-12">
        <div class="card card-widget card-events">
           <div class="card-body">
			@if(count($sessionData))
              <table class="table table-bordered table-centered mb-0 tableData">
                <thead class="table-dark">
                 <tr>
                    <th >Sr No.</th>
                    <th>Session Name</th>
                    <th class="text-center">Start date</th>
                    <th class="text-center">End date</th>
                    <th class="text-center">Cutoff Range</th>
                    <th class="text-center">Fees Type</th>
                    <th class="text-center">Fees </th>
                    <th>Action</th>
                 </tr>
               </thead>
               @php $i=0;@endphp
                @foreach($sessionData as $key=>$data)
                 <tr>
                    <td rowspan="2">{{++$i}}</td>
                    <td rowspan="2">{{$data->session_name}}</td>
                    <td rowspan="2" style="width:14%;">{{date('d-m-Y h:i:s A',strtotime($data->start_date))}}</td>
                    <td rowspan="2" style="width:14%;">{{date('d-m-Y h:i:s A',strtotime($data->end_date))}}</td>
                    <td rowspan="2" style="width:14%;">PH:{{$data->ph}}<br>Category:{{$data->cate}}<br>{{$data->cutoffRange}}</td>
                    <td class="text-right">Application Fee</td>
                    <td class="text-right">&#8377; {{$data->fee_json}}  /-</td>
                    <td rowspan="2">
                      @if($applicationStatus < 9)
                      <button type="button" class="btn btn-apply mb-1" data-id="{{$data->id}}" id="sessionApply"><i class="uil-check"></i> Apply</button>
                      @endif
                      <button type="button" class="btn btn-unlock mb-1" id="profileUnlock" ><i class="uil-unlock-alt"></i> UnLock</button></td>
                 </tr>
                 <tr>
                   <td class="text-right">Security Deposite</td>
                   <td class="text-right">&#8377; {{$data->securityDeposite}}  /-</td>
                 </tr>
                 <tr>
                   <td colspan="6" class="text-right">Total</td>
                   <td class="text-right"><b>&#8377; {{$data->fee_json + $data->securityDeposite}}  /-</b></td>
                 </tr>
                 @endforeach
                
              </table>
               <p class="noteForm"><b>NOTE:-</b> Transaction Charges Are Applicable & Non Refundable.</p>
			@else
				<p> No session available</p>  
			@endif  
     
           </div>
           <div class="card-footer bg-transparent">
           </div>
        </div>
     </div>
</div>
@if(count($sessionData))
<div class="row">
   <div class="col-md-12">
      <div class="">
         <div class="alert alert-danger" id="message" style="display: none"></div>
      </div>
   </div>
</div>
<div class="modal fade" id="unlockProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Please Complete Verification to unlock profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
              <div class="row">
                
              <div class="form-group mb-2">
                <label>Enter OTP sent on mobile<br> <span class="text-muted">मोबाईल नंबरवर पाठवलेला ओटीपी प्रविष्ट करा</span></label>
                <div class="row m-auto">
                  <div class="col-lg-8 pd-0 ">
                    <input type="text" class="form-control" placeholder="Please Enter OTP" name="mobileOtp" id="mobileOtp">
                  </div> 
                  <div class="col-lg-4 pd-0">
                    <button class="btn btn-outline-dark w-100" type="button" id="verifyOtpMobile" name="verifyOtpMobile" onclick="verifyOtp('mobileOtp','encryptMobileOtp','verifyOtpMobile','{{$mobile}}','encryptMobileOtp')">Verify OTP</button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Enter OTP sent on Email-ID<br> <span class="text-muted">ईमेल-आयडीवर पाठविलेला ओटीपी प्रविष्ट करा</span></label>
                <div class="row m-auto">
                  <div class="col-lg-8 pd-0 ">
                    <input type="text" class="form-control" placeholder="Please Enter Email-ID" name="EmailOtp" id="EmailOtp">
                  </div>
                  <div class="col-lg-4 pd-0 ">
                    <button class="btn btn-outline-dark w-100" type="button" id="verifyOtpEmail"  onclick="verifyOtp('EmailOtp','encryptEmailOtp','verifyOtpEmail','{{$email}}','encryptEmailOtp')">Verify OTP</button>
                  </div>
                </div>
              </div>
              <input type="hidden" name="encryptMobileOtp" id="encryptMobileOtp">
              <input type="hidden" name="encryptEmailOtp" id="encryptEmailOtp">
            </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" id="confirmLockProfile">unlock</button>
            </div> <!-- end modal footer -->
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div>
@endif
@endsection
@section('js')
@if(count($sessionData))
<script type="text/javascript">
$(document).on('click', '#profileUnlock', function() {
    $('#encryptMobileOtp').val();
    $('#encryptEmailOtp').val();
    sendOtp('mobile','{{$mobile}}','encryptMobileOtp');
    sendOtp('email','{{$email}}','encryptEmailOtp');
    $('#unlockProfileModal').modal('toggle');
});
$(document).on('click', '#sessionApply', function() {
  $('#message').hide();
  $('#message').html('');
    var sessionId=$('#sessionApply').attr('data-id');
    var url = '{{ route("session.apply", ":sessionId") }}';
    url = url.replace(':sessionId', sessionId);
      $.ajaxSetup({
              headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
             });
       $.ajax({
          url: url,
          type: "get",
          success:function(data) { 
            if(data.status)
            {
              if(data.status=='success') 
                {
                  toastr.success(data.data);
                  window.location.replace("{{route('payment.index')}}");
                }else if(data.status=='error'){
                  toastr.error(data.data);
                }else if(data.status=='multipleError'){
                  $('#message').show();
                  var html='';
                  $.each(data.data, function(key, val) {
                      html+='<li>'+val+'</li>';
                  });
                  $('#message').html(html);
                }
            }
          }
    });
});
$(document).on('click', '#confirmLockProfile', function() {
      $.ajaxSetup({
              headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
             });
       $.ajax({
          url: '{{ route("session.unlock") }}',
          type: "post",
          data: {encryptMobileOtp:$('#encryptMobileOtp').val(),encryptEmailOtp:$('#encryptEmailOtp').val(),mobile:'{{$mobile}}',mobileOtp:$('#mobileOtp').val(),email:'{{$email}}',emailOtp:$('#EmailOtp').val()},
          success:function(data) { 
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
                  toastr.success(data.data);
                  window.location.replace("{{route('personalInfo.index')}}");
                }else{
                  toastr.error(data.data);
                }
            }
          }
    });
});
function sendOtp(inputType,input,otpPutId)
  {
     $.ajaxSetup({
                  headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                 });
           $.ajax({
              url: "{{ route('otp.send') }}",
              type: "post",
              data :{input:input},
              success:function(data) { 
                $(".body_overlay").hide();
                if(data.status)
                {
                  if(data.status=='success') 
                    {
                      $('#'+otpPutId).val(data.data);
                      toastr.success('otp sent successfully');
                    }else{
                      toastr.error(data.data);
                    }
                }
              }
        });
  }
function verifyOtp(selfId,otpId,verifyBtnId,input,otpPutId){
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
          data :{sentOtp:sentOtp,enteredOtp:enteredOtp,input:input},
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
          }
    });
}  
</script>
@endif
@endsection