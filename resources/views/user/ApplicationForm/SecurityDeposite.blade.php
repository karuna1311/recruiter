@extends('layouts.UserDashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">Application Form</h4>
      </div>
   </div>
   <div class="col-12">
      <div class="tab-content">
         <form id="SecurityDepositeForm" method="POST" autocomplete="off">
            @csrf
            <fieldset class="form-fieldset">
               <legend>Security Deposit  </legend>
               <div class="row form-group">
                  <div class="col-md-7 text-right">
                     <label class="d-block">{{ trans('cruds.SecurityDeposite.fields.seat_eng') }}<font class="astr">*</font><br>{{ trans('cruds.SecurityDeposite.fields.seat_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control " name="security_deposite_seat_type"  id="SeatType" required autofocus>
                        <option value="">[SELECT]</option>
                        @if($securityDepositeData->nriq!='YES')
                        <option value="GOVERNMENT SEATS ONLY" {{ (isset($securityDepositeData->security_deposite_seat_type) && $securityDepositeData->security_deposite_seat_type==='GOVERNMENT SEATS ONLY') ? 'selected' : '' }}>GOVERNMENT SEATS ONLY</option>
                        <option value="BOTH GOVERNMENT AND PRIVATE SEATS" {{ (isset($securityDepositeData->security_deposite_seat_type) && $securityDepositeData->security_deposite_seat_type==='BOTH GOVERNMENT AND PRIVATE SEATS') ? 'selected' : '' }}>BOTH GOVERNMENT AND PRIVATE SEATS </option>
                        @else
                        <option value="PRIVATE SEATS" {{ (isset($securityDepositeData->security_deposite_seat_type) && $securityDepositeData->security_deposite_seat_type==='PRIVATE SEATS') ? 'selected' : '' }}>PRIVATE SEATS</option>
                        @endif
                     </select>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-7 text-right">
                     <label class="d-block">{{ trans('cruds.SecurityDeposite.fields.depositeAmount_eng') }}<font class="astr">*</font><br>{{ trans('cruds.SecurityDeposite.fields.depositeAmount_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <p class="uppercase primary_color"><b id="depositeAmount">{{$securityDepositeData->security_deposite_amount??'--'}}</b><b>/-</b></p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 ">
                  <div class="col-md-12 text-right">
                     <button type="submit" class="btn btn-success mb-3">Save And Next</button>
                  </div>
               </div>
            </fieldset>
         </form>
      </div>
   </div>
@endsection
@section('js')
<script>
   $(document).ready(function() {
      $('#SecurityDepositeForm').validate({
         rules: {
            'SeatType' : 'required',
         },
         messages: {
            'SeatType' : 'Please select seat type',
         },
         submitHandler: function(form) {
            $.ajax({
               url : "{{ route('securityDeposite.update', [$securityDepositeData->id]) }}",
               type : 'POST',
               data:$(form).serialize(),
               success : function(data){
                 if (data.ValidatorErrors) {
                      $.each(data.ValidatorErrors, function(index, jsonObject) {
                        $.each(jsonObject, function(key, val) {
                            toastr.error(val);
                        });
                        return false;
                      });
                    }
                    if (data.status) {
                      if(data.status==='error') toastr.error(data.data);
                      else if(data.status==='success'){
                          toastr.success(data.data);
                          window.location.replace("{{route('preview.index')}}");
                        }
                    }
               },
               error:function (response) {
                   let data = response.responseJSON;
                   toastr.error(data);
               }
             });
         }
      });
      $('#SeatType').on('change', function(event) {
        var seatType=$(this).val();
        if(!seatType){
          toastr.error('Please select seat type');
          return false;
        }
         event.preventDefault();
         $.ajaxSetup({
                      headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                     });
               $.ajax({
                  url:"{{ route('securityDeposite.amount') }}",
                  type: "post",
                  data:{seatType:seatType},
                  success:function(response) { 
                    if(response.status='status'){
                      $('#depositeAmount').html(response.data);
                    }
                    
                  },
                  error:function (response) {
                   let data = response.responseJSON;
                   toastr.error(data);
               }
            });
      });
   });
</script>
@endsection