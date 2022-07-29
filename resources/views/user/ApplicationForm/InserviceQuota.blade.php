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
        <form id="InserviceQuotaform" autocomplete="off">
            @csrf
           <fieldset class="form-fieldset">
              <legend>Inservice Quota </legend>
              <div class="row form-group br-bt-1">
                 <div class="col-md-6 text-right">
                    <label class="d-block">{{ trans('cruds.inserviceQuota.fields.inserviceQuota_eng') }}:<font class="astr text-danger">*</font> <br>{{ trans('cruds.inserviceQuota.fields.inserviceQuota_dev') }}:</label>
                 </div>
                 <div class=" col-md-3">
                    <select class="form-control inpField " name="inservice_quota"  id="InserviceQuota">
                       <option value="">[SELECT]</option>
                       <option value="YES" {{ (isset($inserviceData->inservice_quota) && $inserviceData->inservice_quota==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($inserviceData->inservice_quota) && $inserviceData->inservice_quota==='NO') ? 'selected' : '' }}>NO</option>
                    </select>
                 </div>
              </div>
              <div class="row {{ (isset($inserviceData->inservice_quota) && $inserviceData->inservice_quota!='NO') ? 'show' : 'hide' }} quotaDetails" id="quotaDetails">
                <div class="col-md-3 text-right">
                    <label class="d-block">{{ trans('cruds.inserviceQuota.fields.inservice_establishment_eng') }}:<font class="astr text-danger">*</font><br>{{ trans('cruds.inserviceQuota.fields.inservice_establishment_dev') }}:</label>
                 </div>
                 <div class=" col-md-3">
                    <select class="form-control inpField " name="inservice_establishment"  id="establishment">
                       <option value="">[SELECT]</option>
                       <option value="DMER" {{ (isset($inserviceData->inservice_establishment) && $inserviceData->inservice_establishment==='DMER') ? 'selected' : '' }}>DMER</option>
                        <option value="DHS" {{ (isset($inserviceData->inservice_establishment) && $inserviceData->inservice_establishment==='DHS') ? 'selected' : '' }}>DHS</option>
                    </select>
                 </div>

                 <div class="col-md-3 text-right">
                    <label class="d-block">{{ trans('cruds.inserviceQuota.fields.DateOfJoin_eng') }}:<font class="astr text-danger">*</font> <br>{{ trans('cruds.inserviceQuota.fields.DateOfJoin_dev') }}:</label>
                 </div>
                 <div class="col-md-3">
                    <input type="date" class="form-control date" name="inservice_join_date" id="DateOfJoin" value="{{ old('inservice_join_date', isset($inserviceData->inservice_join_date) ? date(config('panel.date_format'),strtotime($inserviceData->inservice_join_date)) : '') }}" min="{{config('datevalidation.min_date')}}">
                 </div>
                 <div class="col-md-6 text-right">
                    <label class="d-block">{{ trans('cruds.inserviceQuota.fields.PostingAdd_eng') }}:<font class="astr text-danger">*</font> <br>{{ trans('cruds.inserviceQuota.fields.PostingAdd_dev') }}:</label>
                 </div>
                 <div class=" col-md-3">
                    <input type="text" class="form-control" name="inservice_posting_addr" id="PostingAdd" value="{{ old('inservice_posting_addr', isset($inserviceData->inservice_posting_addr) ? $inserviceData->inservice_posting_addr : '') }}">
                 </div>
                 <div class="col-md-6 text-right">
                    <label class="d-block">{{ trans('cruds.inserviceQuota.fields.noc_eng') }}:<font class="astr text-danger">*</font><br>{{ trans('cruds.inserviceQuota.fields.noc_dev') }}:</label>
                 </div>
                 <div class=" col-md-3">
                    <select class="form-control inpField " name="inservice_establish_noc"  id="Noc">
                       <option value="">[SELECT]</option>
                        <option value="YES" {{ (isset($inserviceData->inservice_establish_noc) && $inserviceData->inservice_establish_noc==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($inserviceData->inservice_establish_noc) && $inserviceData->inservice_establish_noc==='NO') ? 'selected' : '' }}>NO</option>
                    </select>
                 </div>
                 <div class="col-md-6 text-right NocDate {{ (isset($inserviceData->inservice_establish_noc) && $inserviceData->inservice_establish_noc!='NO') ? 'show' : 'hide' }}">
                    <label class="d-block">B) {{ trans('cruds.inserviceQuota.fields.NocIssuingDate_eng') }}:<font class="astr text-danger">*</font><br>{{ trans('cruds.inserviceQuota.fields.NocIssuingDate_dev') }}:</label>
                 </div>
                 <div class=" col-md-3 NocDate {{ (isset($inserviceData->inservice_establish_noc) && $inserviceData->inservice_establish_noc!='NO') ? 'show' : 'hide' }}">
                    <input type="date" class="form-control date" name="inservice_establish_noc_date" id="NocIssuingDate" value="{{ old('inservice_establish_noc_date', isset($inserviceData->inservice_establish_noc_date) ? date(config('panel.date_format'),strtotime($inserviceData->inservice_establish_noc_date)) : '') }}" max="{{config('datevalidation.inservice_quota.noc')}}"  min="{{config('datevalidation.inservice_quota.min_noc')}}">
                 </div>


                 <div class="col-md-6 text-right" >
                    <label class="d-block">{{ trans('cruds.inserviceQuota.fields.DeptInq_eng') }}:<font class="astr text-danger">*</font><br>{{ trans('cruds.inserviceQuota.fields.DeptInq_dev') }}:</label>
                 </div>
                 <div class=" col-md-3">
                    <select class="form-control" name="inservice_dept_enquiry" id="DeptInq">
                        <option value="">[SELECT]</option>
                        <option value="YES" {{ (isset($inserviceData->inservice_dept_enquiry) && $inserviceData->inservice_dept_enquiry==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($inserviceData->inservice_dept_enquiry) && $inserviceData->inservice_dept_enquiry==='NO') ? 'selected' : '' }}>NO</option>
                    </select>
                 </div>
                 <div class="col-md-6 text-right DeptInqDetails {{ (isset($inserviceData->inservice_dept_enquiry) && $inserviceData->inservice_dept_enquiry!='NO') ? 'show' : 'hide' }}" >
                    <label class="d-block"> {{ trans('cruds.inserviceQuota.fields.InqDetails_eng') }}:<font class="astr text-danger">*</font><br>{{ trans('cruds.inserviceQuota.fields.InqDetails_dev') }}:</label>
                 </div>
                 <div class="col-md-3 DeptInqDetails {{ (isset($inserviceData->inservice_dept_enquiry) && $inserviceData->inservice_dept_enquiry!='NO') ? 'show' : 'hide' }}">
                    <input type="text" class="form-control" name="inservice_dept_enquiry_details" id="InqDetails" value="{{ old('inservice_dept_enquiry_details', isset($inserviceData->inservice_dept_enquiry_details) ? $inserviceData->inservice_dept_enquiry_details : '') }}">
                 </div>

              </div>
              <div class="row form-group">
                 <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success mb-3">Save And Next</button>
                 </div>
              </div>
           </fieldset>
        </form>
     </div>
  </div>
</div> 
@endsection
@section('js')         
<script>
$(document).on('change', '#InserviceQuota', function() {
    document.getElementById('DateOfJoin').value = "";
    document.getElementById('PostingAdd').value = "";
    document.getElementById('Noc').value = "";
    document.getElementById('NocIssuingDate').value = "";
    document.getElementById('DeptInq').value = "";
    document.getElementById('InqDetails').value = "";
    $('#establishment').val('');
    $('.NocDate').hide();
    var quota = $(this).val();
    if (quota == "YES") {
        $('.quotaDetails').css('display', 'flex');
    } else {
        $('.quotaDetails').hide();
    }
});
//NOC
$(document).on('change', '#Noc', function() {
    document.getElementById('NocIssuingDate').value = "";
    var quota = $(this).val();
    if (quota == "YES") {
        $('.NocDate').show();
    } else {
        $('.NocDate').hide();
    }
});  
//DeptInq
$(document).on('change', '#DeptInq', function() {
    document.getElementById('InqDetails').value = "";
    var DeptInq = $(this).val();
    if (DeptInq == "YES") {
        $('.DeptInqDetails').show();
    } else {
        $('.DeptInqDetails').hide();
    }
}); 
$(document).ready(function () {
    $('#InserviceQuotaform').validate({
        rules: {
            inservice_quota: "required",
            inservice_establishment: {
                required: function () {
                    if ($('#InserviceQuota').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            inservice_join_date: {
                required: function () {
                    if ($('#InserviceQuota').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                },
                date:function(){
                  return true;
                }
            },
            inservice_posting_addr: {
                required: function () {
                    if ($('#InserviceQuota').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
            inservice_establish_noc:{
                required: function () {
                    if ($('#InserviceQuota').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
            inservice_establish_noc_date:{
                required: function () {
                    if ($('#Noc').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
            inservice_dept_enquiry:{
                required: function () {
                    if ($('#InserviceQuota').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
            inservice_dept_enquiry_details:{
                required: function () {
                    if ($('#InserviceQuota').val() === 'YES' && $('#DeptInq').val() === 'YES') {
                        return true;
                    } else {
                        return false;
                    }
                },
            }
        },
        messages: {
            inservice_quota:{
              required :"Please Select Inservice Quota"
            },
            inservice_establishment:{
                required :"Please Specify the Establishment"
            },
            inservice_join_date:{
                required :"Please select Date of Joining Permanent Service"
            },
            inservice_posting_addr:{
                 required :"Please enter Posting address of the Permanent Service"
            },
            inservice_establish_noc:{
                required :"Are You obtained NOC from respective Establishment?"
            },
            inservice_establish_noc_date:{
                 required :"Please select Noc Issuing Date",
                 max :"Please enter a date less than or equal to 02-05-2022."
            },
            inservice_dept_enquiry:{
                 required :"Please select Departmental Enquiry is initiated/Pending"
            },
            InqDetails:{
                required :"Please enter Enquiry Details"
            }
        },
        submitHandler: function (form) {
            $.ajax({
             url: "{{ route('inserviceQuota.update', [$inserviceData->id])}}",
             data: $(form).serialize(),
             type: 'PUT',
               beforeSend: function() {
             
            // setting a InserviceQuota
             var inserviceQuota = $('#InserviceQuota').val();
             var noc = $('#Noc').val();
             
                    if(inserviceQuota == 'YES' && noc == "NO") {
                        toastr.error('You must obtained Noc From respectable Establishment.');
                        return false;
                    }else{
                        return true;
                    };
                },
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
                        window.location.replace("{{route('collegeInfo.index')}}");
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
});
</script>
@endsection