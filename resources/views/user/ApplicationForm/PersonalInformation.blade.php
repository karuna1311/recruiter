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
         <form id="personalform" autocomplete="off">
            @csrf
            <fieldset class="form-fieldset">
               <legend>{{ trans('cruds.personalInformation.title_eng') }} <span class="text-muted">{{ trans('cruds.personalInformation.title_dev') }}</span></legend>
               <div class="row form-group">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.name_eng') }}  <br>{{ trans('cruds.personalInformation.fields.name_dev') }}:</label>
                  </div>
                  <div class=" col-md-6">
                     <input type="text" id="firstname" class="form-control"  value="{{ old('firstname', isset($userData) ? $userData['name'] : '--') }}" readonly>
                  </div>
               </div>
               <div class="row form-group ">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.namchange_eng') }} :<font class="astr">*</font><br>{{ trans('cruds.personalInformation.fields.namchange_dev') }} ?</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control" name="cname_change" id="namchange">
                     <option value="" @if(!isset($personalInfoData)) selected @endif>[SELECT]</option>
                     <option value="YES" {{ (isset($personalInfoData) && $personalInfoData->cname_change==='YES') ? 'selected' : '' }}>YES</option>
                     <option value="NO" {{ (isset($personalInfoData) && $personalInfoData->cname_change==='NO') ? 'selected' : '' }}>NO</option>
                     </select>
                  </div>
                  <div class="col-md-3 @if(!(isset($personalInfoData) && $personalInfoData->cname_change=='YES')) hide @endif NameDetails" >
                     <input type="text" class="form-control" name="cname_change_value" id="updatedName" placeholder="Enter Name" value="{{ old('cname_change_value', isset($personalInfoData) ? $personalInfoData->cname_change_value : '') }}">
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-2 text-right">
                     <label class="d-block ">{{ trans('cruds.personalInformation.fields.fatherName_Eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.fatherName_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter your Father's Name" value="{{ old('fname', isset($personalInfoData) ? $personalInfoData->fname : '') }}">
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.motherName_Eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.personalInformation.fields.motherName_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" id="mname" name="mname" class="form-control" placeholder="Enter your Mother's Name" value="{{  isset($userData) ? $userData['mother_name'] : '--' }}" readonly >
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.gender_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.personalInformation.fields.Gender_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <select class="form-control inpField" name="gender"  id="gender">
                     <option value="" @if(!isset($personalInfoData)) selected @endif>[SELECT]</option>
                     <option value="MALE" {{ (isset($personalInfoData) && $personalInfoData->gender==='MALE') ? 'selected' : '' }}>MALE</option>
                     <option value="FEMALE" {{ (isset($personalInfoData) && $personalInfoData->gender==='FEMALE') ? 'selected' : '' }}>FEMALE</option>
                     <option value="TRANSGENDER" {{ (isset($personalInfoData) && $personalInfoData->gender==='TRANSGENDER') ? 'selected' : '' }}>TRANSGENDER</option>
                     </select>
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.DateOfBirth_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.DateOfBirth_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control"  id="dob" maxlength="10" value="{{ old('dob', isset($userData) ? $userData['dob'] : '--') }}"  readonly>
                  </div>
               </div>
               <div class="row form-group ">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.Mobile_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.Mobile_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" id="mobile" maxlength="10" value="{{ old('mobile', isset($userData) ? $userData['mobile'] : '--') }}" readonly>
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.email_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.email_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control"  id="email"  value="{{ old('email', isset($userData) ? $userData['email'] : '--') }}" readonly >
                  </div>
               </div>
               <div class="row form-group ">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.alternateContact_eng') }}:<br> {{ trans('cruds.personalInformation.fields.alternateContact_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="alternate_mobile" id="alt_no" maxlength="10"  value="{{ old('alternate_mobile', isset($personalInfoData) ? $personalInfoData->alternate_mobile : '') }}">
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.aadhar_eng') }}:<br> {{ trans('cruds.personalInformation.fields.aadhar_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="adhar_card_no" id="adharcardno" maxlength="12" value="{{ old('adhar_card_no', isset($personalInfoData) ? $personalInfoData->adhar_card_no : '') }}">
                  </div>
               </div>
            </fieldset>
            <fieldset class="form-fieldset mt-3">
               <legend>{{ trans('cruds.personalInformation.fields.PermanentAdd_eng') }}<span class="text-muted">{{ trans('cruds.personalInformation.fields.PermanentAdd_dev') }}</span></legend>
               <div class="row form-group">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine1_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.addressLine1_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="permanent_address_1" id="address1" maxlength="50" value="{{ old('permanent_address_1', isset($personalInfoData) ? $personalInfoData->permanent_address_1 : '') }}">
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine2_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.addressLine2_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="permanent_address_2" id="address2" maxlength="50" value="{{ old('permanent_address_2', isset($personalInfoData) ? $personalInfoData->permanent_address_2 : '') }}">
                  </div>
               </div>
               <div class="row form-group ">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine3_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.addressLine3_dev') }}:</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="permanent_address_3" id="address3" maxlength="50" value="{{ old('permanent_address_3', isset($personalInfoData) ? $personalInfoData->permanent_address_3 : '') }}">
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.city_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.city_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="permanent_city" id="City" maxlength="50" value="{{ old('permanent_city', isset($personalInfoData) ? $personalInfoData->permanent_city : '') }}">
                  </div>
               </div>
               <div class="row form-group ">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.state_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.state_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <select class="form-control inpField select2" name="permanent_state"  id="State" onchange="getLocation('District','district',$(this).val())">
                     @foreach ($stateData as $key=>$value)
                     <option value="{{ $key}}" {{ (isset($personalInfoData) && $personalInfoData->permanent_state== $key) ? 'selected' : '' }} >{{$value}}</option>
                     @endforeach
                     </select>
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.district_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.district_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <select class="form-control inpField select2" name="permanent_district"  id="District" onchange="getLocation('Taluka','subDistrict',$('#State').val(),$(this).val())">                        
                        @if(isset($personalInfoData->permanent_district))                        
                           @foreach ($districtData as $key=>$value)
                           <option value="{{ $key}}" {{ (isset($personalInfoData) && $personalInfoData->permanent_district== $key) ? 'selected' : '' }} >{{$value}}</option>
                           @endforeach
                        @else
                           <option value="" selected>[SELECT]</option> 
                        @endif
                     </select>
                  </div>
               </div>
               <div class="row form-group ">
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.taluka_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.taluka_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                     <select class="form-control inpField select2" name="permanent_taluka"  id="Taluka" onchange="getLocation('pincode','pincode',$('#State').val(),$('#District').val(),$(this).val())">       
                        @if(isset($personalInfoData->permanent_taluka))                        
                           @foreach ($talukaData as $key=>$value)
                           <option value="{{ $key}}" {{ (isset($personalInfoData) && $personalInfoData->permanent_taluka== $key) ? 'selected' : '' }} >{{$value}}</option>
                           @endforeach
                        @else
                        <option value="" selected>[SELECT]</option> 
                        @endif
                     </select>
                  </div>
                  <div class="col-md-2 text-right">
                     <label class="d-block">{{ trans('cruds.personalInformation.fields.PinCode_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.PinCode_dev') }} :</label>
                  </div>
                  <div class="col-md-4">
                   
                     <input type="text" class="form-control" name="permanent_pin_code" id="pincode" maxlength="6" value="{{ old('permanent_pin_code', isset($personalInfoData->permanent_pin_code) ? $personalInfoData->permanent_pin_code : '') }}">
                  </div>
               </div>
               <div class=" ">
                  <input type="checkbox" class="PresentAdd"  name="address_not_same" id="PresentAdd"  value='1' onchange="valueChanged()" {{ ( isset($personalInfoData) && $personalInfoData->address_not_same) ? 'checked' : '' }}>
                  &nbsp;&nbsp; Present Address Not Same With Permanent Address <span class="text-muted">स्थायी पत्ता व  वर्तमान पत्ता समान  नाही</span>
               </div>
            </fieldset>
            <fieldset class="form-fieldset mt-3 @if(!(isset($personalInfoData) && $personalInfoData->address_not_same)) hide @endif mb-3" id="presentAddressDiv">
               <legend>Present Address <span class="text-muted">वर्तमान पत्ता</span></legend>
               <div >
                  <div class="row form-group  presentAddressDiv" >
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine1_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.personalInformation.fields.addressLine1_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="present_address_1" id="present_addressline1" maxlength="50" value="{{ old('present_address_1', isset($personalInfoData) ? $personalInfoData->present_address_1 : '') }}">
                     </div>
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine2_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.addressLine2_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="present_address_2" id="present_addressline2" maxlength="50" value="{{ old('present_address_2', isset($personalInfoData) ? $personalInfoData->present_address_2 : '') }}">
                     </div>
                  </div>
                  <div class="row form-group  presentAddressDiv ">
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine3_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.addressLine3_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="present_address_3" id="present_addressline3" maxlength="50" value="{{ old('present_address_3', isset($personalInfoData) ? $personalInfoData->present_address_3 : '') }}">
                     </div>
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.city_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.city_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="present_city" id="present_City" maxlength="50" value="{{ old('present_address_3', isset($personalInfoData) ? $personalInfoData->present_address_3 : '') }}">
                     </div>
                  </div>
                  <div class="row form-group presentAddressDiv ">
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.state_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.state_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <select class="form-control inpField select2" name="present_state"  id="present_state" onchange="getLocation('present_dist2','district',$(this).val())">
                        
                        @foreach ($stateData as $key=>$value)
                           <option value="{{ $key}}" {{ (isset($personalInfoData) && $personalInfoData->present_state== $key) ? 'selected' : '' }} >{{$value}}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.district_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.district_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <select class="form-control inpField select2" name="present_district"  id="present_dist2" onchange="getLocation('present_Taluka','subDistrict',null,$(this).val())">
                         
                           @if(isset($personalInfoData->present_district))                        
                           @foreach ($districtData as $key=>$value)
                           <option value="{{ $key}}" {{ (isset($personalInfoData) && $personalInfoData->present_district== $key) ? 'selected' : '' }} >{{$value}}</option>
                           @endforeach
                        @else
                           <option value="" selected>[SELECT]</option> 
                        @endif
                        </select>
                     </div>
                  </div>
                  <div class="row form-group presentAddressDiv ">
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.taluka_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.taluka_dev') }} :</label>
                     </div>
                     <div class="col-md-4">
                        <select class="form-control inpField select2" name="present_taluka"  id="present_Taluka" onchange="getLocation('present_PinCode','pincode',null,$('#present_dist2').val(),$(this).val())">
                         
                           @if(isset($personalInfoData->present_taluka))                        
                           @foreach ($talukaData as $key=>$value)
                           <option value="{{ $key}}" {{ (isset($personalInfoData) && $personalInfoData->permanent_taluka== $key) ? 'selected' : '' }} >{{$value}}</option>
                           @endforeach
                        @else
                        <option value="" selected>[SELECT]</option> 
                        @endif
                        </select>
                     </div>
                     <div class="col-md-2 text-right">
                        <label class="d-block">{{ trans('cruds.personalInformation.fields.PinCode_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.personalInformation.fields.PinCode_dev') }}:</label>
                     </div>
                     <div class="col-md-4">
                      
                        <input type="text" class="form-control" name="present_pin_code" id="present_pin_code" maxlength="6" value="{{ old('present_pin_code', isset($personalInfoData->present_pin_code) ? $personalInfoData->present_pin_code : '') }}">

                     </div>
                  </div>
               </div>
            </fieldset>
            <div class="row form-group  mt-3 ">
               <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn-success mb-3" id="submitpersonal">Save And Next</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
   $(document).on('change', '#namchange', function() {
       document.getElementById('updatedName').value = "";
       var namchange = $(this).val();
       if (namchange == "YES") {
           $('.NameDetails').show();
       } else {
           $('.NameDetails').hide();
       }
   });  
   function valueChanged() {
           $('#present_addressline1').val('');
           $('#present_addressline2').val('');
           $('#present_addressline3').val('');
           $('#present_City').val('');
           $('#present_state').val('');
           $('#present_dist2').val('');
           $('#present_PinCode').val('');
           $('#present_Taluka').val('');
       if ($('.PresentAdd').is(":checked")) {
           $('#presentAddressDiv').show();
       } else {
           $("#presentAddressDiv").hide();
       }
    }
   $(document).ready(function() {
      $.validator.addMethod("notOnlyZero", function (value, element, param) {
    return this.optional(element) || parseInt(value) > 0;
});

        $('#personalform').validate({
            rules: {
               cname_change:"required",
               cname_change_value: {
                     required: function () {
                         if ($('#namchange').val()==='YES') return true;else return false;
                     },
                 },
               fname : "required",
               mname : "required",
               gender : "required",
               alternate_mobile : {number: true,minlength: 10,maxlength: 10},
               adhar_card_no : {number: true,minlength: 12,maxlength: 12},
               permanent_address_1 : "required",
               permanent_address_2 : "required",
               permanent_address_3 : "required",
               permanent_state : "required",
               permanent_city : "required",
               permanent_district : "required",
               permanent_taluka : "required",
               permanent_pin_code:"required",
               present_address_1 : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_address_2 : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_address_3 : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_city : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_state : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_district : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_taluka : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_pin_code : {required: function () { return $('#PresentAdd').prop('checked') == true;}},
               present_district: {
                     notOnlyZero: '0'
               }
            },
            messages: {
                fname: "Please enter father name",
                mname: "Please enter mother name",
                cname_change_value:"Please enter Updated Name",
                gender: "Please select gender",
                adhar_card_no: "Please enter valid Aadhar number",
                permanent_address_1: "Please provide address line 1",
                permanent_address_2: "Please provide address line 2",
                permanent_address_3: "Please provide address line 3",
                permanent_state: "Please select state",
                permanent_city: "please Enter City Name",
                permanent_district: "Please select district",
                permanent_taluka: "Please select taluka",
                permanent_pin_code: "Please select pincode",
                present_address_1 :  "Please provide address line 1",
               present_address_2 : "Please provide address line 2",
               present_address_3 :"Please provide address line 3",
               present_state : "Please Select state ",
               present_city : "Please Enter City Name ",
               present_district : "Please Select district",
               present_taluka : "Please Select taluka",
               present_pin_code:"Please select pincode",
               alternate_mobile:"Phone number should be  10 Digit."
    
            },
            submitHandler: function(form) {
            
               var data=serialiseData('personalform');
                $.ajaxSetup({
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url : "{{ isset($personalInfoData) ? route('personalInfo.update', [$personalInfoData->id]) : route('personalInfo.store')}}",
                    data: values,
                    type : "{{isset($personalInfoData) ? 'PUT' : 'POST'}}",
                    
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
                             window.location.replace("{{route('reservation.index')}}");
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
@include('include.user.UserCustomJs')
@endsection