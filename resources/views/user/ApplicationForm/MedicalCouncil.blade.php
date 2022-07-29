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
      <form id="medicalCouncilForm" method="POST" autocomplete="off">
         @csrf
         <fieldset class="form-fieldset">
            <legend>{{ trans('cruds.DcCouncil.title') }}  </legend>
            <div class="row form-group  ">
               <div class="col-md-7 text-right">
                  <label class="d-block">{{ trans('cruds.DcCouncil.fields.MedicalCouncil_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.DcCouncil.fields.MedicalCouncil_dev') }}:</label>
               </div>
               <div class=" col-md-3">
                  <select class="form-control " name="medical_council_reg"  id="MedicalCouncil" required autofocus>
                     <option value="">[SELECT]</option>
                     <option value="YES" {{ (isset($medicalCouncilData->medical_council_reg) && $medicalCouncilData->medical_council_reg==='YES') ? 'selected' : '' }}>Yes</option>
                     <option value="NO" {{ (isset($medicalCouncilData->medical_council_reg) && $medicalCouncilData->medical_council_reg==='NO') ? 'selected' : '' }}>No </option>
                  </select>
                  <p class="error hide" id="MedicalCouncilError">Valid registration is required</p>
               </div>
            </div>
            <div class="row form-group {{ (isset($medicalCouncilData->medical_council_reg) && $medicalCouncilData->medical_council_reg!='NO') ? 'show' : 'hide' }} MedicalCouncilDetails">
               <div class="col-md-7 text-right">
                  <label class="d-block">{{ trans('cruds.DcCouncil.fields.MedicalCouncilReg_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.DcCouncil.fields.MedicalCouncilReg_dev') }}:</label>
               </div>
               <div class=" col-md-3">
                  <input type="text" class="form-control" name="medical_council_reg_no" id="MedicalCouncilReg"  autofocus placeholder="Enter MCR No." value="{{ old('medical_council_reg_no', isset($medicalCouncilData->medical_council_reg_no) ? $medicalCouncilData->medical_council_reg_no : '') }}">
               </div>
            </div>
            <div class="row form-group">
               <div class="col-md-7 text-right">
                  <label class="d-block">{{ trans('cruds.DcCouncil.fields.dci_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.DcCouncil.fields.dci_dev') }} :</label>
               </div>
               <div class=" col-md-3">
                  <select class="form-control " name="medical_dci_reg"  id="dci" required autofocus>
                     <option value="">[SELECT]</option>
                     <option value="YES" {{ (isset($medicalCouncilData->medical_dci_reg) && $medicalCouncilData->medical_dci_reg==='YES') ? 'selected' : '' }}>YES</option>
                     <option value="NO" {{ (isset($medicalCouncilData->medical_dci_reg) && $medicalCouncilData->medical_dci_reg==='NO') ? 'selected' : '' }}>NO</option>
                  </select>
               </div>
            </div>
            <div class="row form-group {{ (isset($medicalCouncilData->medical_dci_reg) && $medicalCouncilData->medical_dci_reg==='YES') ? 'show' : 'hide' }} dcimReceipt">
               <div class="col-md-7 text-right"> 
                  <label class="d-block">{{ trans('cruds.DcCouncil.fields.dcinumber_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.DcCouncil.fields.dcinumber_dev') }}:</label>
               </div>
               <div class=" col-md-3">
                  <input type="text" class="form-control" name="medical_dci_reg_no" id="dcinumber" value="{{ old('medical_dci_reg_no', isset($medicalCouncilData->medical_dci_reg_no) ? $medicalCouncilData->medical_dci_reg_no : '') }}">
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
      $('#medicalCouncilForm').validate({
         rules: {
            'medical_council_reg' : 'required',
            'medical_council_reg_no' : { required:function(){return $('#MedicalCouncil').val() != 'NO';} },
            'medical_dci_reg' : 'required',
            'medical_dci_reg_no' : { required:function(){return $('#dci').val() != 'NO';} },
         },
         messages: {
            medical_council_reg : 'Medical Council Registration is required',
         medical_council_reg_no : 'Medical Council Registration Number is required',
            dcim : 'Please select State Registration',
            dcinumber : 'Please enter Registration No. / Receipt No.',
            medical_dci_reg_no:"Please Enter Registration No. / Receipt No. "
         },
         submitHandler: function(form) {
            $.ajax({
               url : "{{ route('medicalCouncil.update', [$medicalCouncilData->id]) }}",
               type : 'put',
               data:$(form).serialize(),
              beforeSend: function() {
                if($('#MedicalCouncil').val()===$('#dci').val()){
                  toastr.error('Please select any one Maharashtra State D.C. Registration or D.C.I/ Other State Registration');
                  return false;
                }
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
                          window.location.replace("{{route('securityDeposite.index')}}");
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
   $(document).on('change', '#MedicalCouncil', function() {
    document.getElementById('MedicalCouncilReg').value = "";
    var MedicalCouncil = $(this).val();
   if (MedicalCouncil == "YES" || MedicalCouncil == "APPLIED") {
        $('.MedicalCouncilDetails').css('display', 'flex');
         $('#MedicalCouncilError').hide();
    }
    else {
        $('.MedicalCouncilDetails').hide();
         $('#MedicalCouncilError').show();
        
    }
   });
   $(document).on('change', '#dci', function() {
    document.getElementById('dcinumber').value = "";
    var dci = $(this).val();
   if (dci == "YES") {
        $('.dcimReceipt').css('display', 'flex');
    }
    else {
        $('.dcimReceipt').hide();
        
    }
   });
</script>
@endsection