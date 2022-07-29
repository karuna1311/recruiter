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
         <form id="collegeInfoForm" method="POST" autocomplete="off">
            @csrf
            <fieldset class="form-fieldset">
               <legend>{{ trans('cruds.CollegeInformation.title_eng') }} <span class="text-muted"> {{ trans('cruds.CollegeInformation.title_dev') }}</span></legend>
               <div class="row form-group br-bt-1 mb-2">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DegreeExam_eng') }}:<font class="astr">*</font>  <br>{{ trans('cruds.CollegeInformation.fields.DegreeExam_dev') }}:</label>
                  </div>
                  <div class="col-md-3">
                     <input type="date" class="form-control" name="mbbs_passing_date" id="DegreeExam" required autofocus value="{{ old('mbbs_passing_date', isset($collegeInfoData->mbbs_passing_date) ? date(config('panel.date_format'),strtotime($collegeInfoData->mbbs_passing_date)) : '') }}" min="{{config('datevalidation.min_date')}}">
                  </div>
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.PercentageMBBS_eng') }}:<font class="astr">*</font>  <br>{{ trans('cruds.CollegeInformation.fields.PercentageMBBS_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <input type="text" class="form-control" name="mbbs_agg_per" id="PercentageMBBS" required autofocus placeholder="Enter Aggregate %" minlength=5 maxlength=5 value="{{ old('mbbs_passing_date', isset($collegeInfoData->mbbs_agg_per) ? $collegeInfoData->mbbs_agg_per : '') }}">
                  </div>
               </div>
               <div class="row form-group br-bt-1 mb-3">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DateofIntern_eng') }}:<font class="astr">*</font>  <br>{{ trans('cruds.CollegeInformation.fields.DateofIntern_dev') }}</label>
                  </div>
                  <div class=" col-md-3">
                     <input type="date" class="form-control" name="mbbs_internship_date" id="DateofIntern" required autofocus  max="2022-07-31" required autofocus value="{{ old('mbbs_internship_date', isset($collegeInfoData->mbbs_internship_date) ? date(config('panel.date_format'),strtotime($collegeInfoData->mbbs_internship_date)) : '') }}" max="{{config('datevalidation.college_info.internship_date')}}" min="{{config('datevalidation.college_info.min_internship_date')}}">
                  </div>
               </div>
               <div class="row form-group br-bt-1 mb-2">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DiplomaCourse_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.DiplomaCourse_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control" name="mci_reg_diploma"  id="DiplomaCourse" required autofocus>
                        <option value="">[SELECT]</option>
                         <option value="YES" {{ (isset($collegeInfoData->mci_reg_diploma) && $collegeInfoData->mci_reg_diploma==='YES') ? 'selected' : '' }}>YES</option>
                         <option value="NO" {{ (isset($collegeInfoData->mci_reg_diploma) && $collegeInfoData->mci_reg_diploma==='NO') ? 'selected' : '' }}>NO </option>
                        <option value="COMPLETED" {{ (isset($collegeInfoData->mci_reg_diploma) && $collegeInfoData->mci_reg_diploma==='COMPLETED') ? 'selected' : '' }}>COMPLETED </option>
                       
                     </select>
                     <p id="DiplomaCourseError" class="error hide">* Diploma pursuing candidate are not eligible</p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 {{ (isset($collegeInfoData->mci_reg_diploma) && $collegeInfoData->mci_reg_diploma==='COMPLETED') ? 'show' : 'hide' }} DiplomaCourseDetails">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.SubofDiploma_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.SubofDiploma_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control" name="diploma_subject"  id="SubofDiploma" autofocus>
                        <option value="">SELECT</option>
                        @foreach($diplomaSubjectList as $value)
                        <option value="{{$value}}" {{ (isset($collegeInfoData->diploma_subject) && $collegeInfoData->diploma_subject===$value) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="row form-group br-bt-1 ">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DegreeCourse_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.DegreeCourse_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control" name="mci_reg_degree"  id="DegreeCourse" required autofocus>
                        <option value="">[SELECT]</option>
                        <option value="YES" {{ (isset($collegeInfoData->mci_reg_degree) && $collegeInfoData->mci_reg_degree==='YES') ? 'selected' : '' }}>YES </option>
                        <option value="NO" {{ (isset($collegeInfoData->mci_reg_degree) && $collegeInfoData->mci_reg_degree==='NO') ? 'selected' : '' }}>NO </option>
                        <option value="COMPLETED" {{ (isset($collegeInfoData->mci_reg_degree) && $collegeInfoData->mci_reg_degree==='COMPLETED') ? 'selected' : '' }}>COMPLETED </option>
                        
                     </select>
                     <p id="DegreeCourseError" class="error hide">* Degree is compulsory</p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 {{ (isset($collegeInfoData->mci_reg_degree) && $collegeInfoData->mci_reg_degree==='COMPLETED') ? 'show' : 'hide' }} DegreeCourseDetails">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.SubofDegree_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.SubofDegree_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control" name="degree_subject"  id="degree_subject" autofocus>
                        <option value="">SELECT</option>
                        @foreach($diplomaSubjectList as $value)
                        <option value="{{$value}}" {{ (isset($collegeInfoData->degree_subject) && $collegeInfoData->degree_subject===$value) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="row form-group br-bt-1 ">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.MBBSDegree_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.MBBSDegree_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control " name="mbbs_dc_in_mh_or_aiims"  id="MBBSDegree" required autofocus>
                        <option value="">[SELECT]</option>
                        <option value="YES" {{ (isset($collegeInfoData->mbbs_dc_in_mh_or_aiims) && $collegeInfoData->mbbs_dc_in_mh_or_aiims==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($collegeInfoData->mbbs_dc_in_mh_or_aiims) && $collegeInfoData->mbbs_dc_in_mh_or_aiims==='NO') ? 'selected' : '' }}>NO</option>
                     </select>
                     <p class="error hide" id="mbbs_dergee"></p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 {{ (isset($collegeInfoData->mbbs_dc_in_mh_or_aiims) || isset($collegeInfoData->mbbs_college_outoff_ind_mah)) ? 'show' : 'hide' }} CollegeTypeDetails">
                  <div class="col-md-6 text-right MBBSDegreeYes {{ (isset($collegeInfoData->mbbs_college_type) && isset($collegeInfoData->mbbs_dc_in_mh_or_aiims) && $collegeInfoData->mbbs_dc_in_mh_or_aiims==='YES') ? 'show' : 'hide' }}">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.CollegeType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.CollegeType_dev') }}:</label>
                  </div>
                  <div class="col-md-3 {{ (isset($collegeInfoData->mbbs_college_type) && isset($collegeInfoData->mbbs_dc_in_mh_or_aiims) && $collegeInfoData->mbbs_dc_in_mh_or_aiims==='YES') ? 'show' : 'hide' }} MBBSDegreeYes">
                     <select class="form-control" name="mbbs_college_type"  id="CollegeType" autofocus>
                        <option value="">[SELECT]</option>
                        <option value="GOVERNMENT" {{ (isset($collegeInfoData->mbbs_college_type) && $collegeInfoData->mbbs_college_type==='GOVERNMENT') ? 'selected' : '' }}>GOVERNMENT </option>
                        <option value="PRIVATE" {{ (isset($collegeInfoData->mbbs_college_type) && $collegeInfoData->mbbs_college_type==='PRIVATE') ? 'selected' : '' }}>PRIVATE </option>
                        <option value="AIIMS OR CENTRAL GOVT INSTITUTION" {{ (isset($collegeInfoData->mbbs_college_type) && $collegeInfoData->mbbs_college_type==='AIIMS OR CENTRAL GOVT INSTITUTION') ? 'selected' : '' }}>AIIMS OR CENTRAL GOVT INSTITUTION</option>
                     </select>
                  </div>
                  <div class="col-md-6 text-right {{ (isset($collegeInfoData->mbbs_college_outoff_ind_mah)) ? 'show' : 'hide' }} MBBSDegreeNo">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.GovtClg_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.GovtClg_dev') }}</label>
                  </div>
                  <div class="col-md-3 {{ (isset($collegeInfoData->mbbs_college_outoff_ind_mah)) ? 'show' : 'hide' }} MBBSDegreeNo">
                     <select class="form-control" name="mbbs_college_outoff_ind_mah"  id="mbbs_College_Type_No" autofocus>
                        <option value="">[SELECT]</option>
                        <option value="DENTAL COLLEGE OUT OF INDIA" {{ (isset($collegeInfoData->mbbs_college_outoff_ind_mah) && $collegeInfoData->mbbs_college_outoff_ind_mah==='DENTAL COLLEGE OUT OF INDIA') ? 'selected' : '' }}>DENTAL COLLEGE OUT OF INDIA</option>
                        <option value="DENTAL COLLEGE OUT OF MAHARASHTRA STATE" {{ (isset($collegeInfoData->mbbs_college_outoff_ind_mah) && $collegeInfoData->mbbs_college_outoff_ind_mah==='DENTAL COLLEGE OUT OF MAHARASHTRA STATE') ? 'selected' : '' }}>DENTAL COLLEGE OUT OF MAHARASHTRA STATE</option>
                     </select>
                     <p id="mbbs_college_type_error" class="error hide"></p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 {{ (isset($collegeInfoData->mbbs_college_outoff_ind_mah) || (isset($collegeInfoData->mbbs_college_type) && $collegeInfoData->mbbs_college_type==='AIIMS OR CENTRAL GOVT INSTITUTION')) ? 'show' : 'hide' }} clgDetails">
                  <div class="col-md-3 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_dev') }}: </label>
                  </div>
                  <div class="col-md-3  ">
                     <input type="text" class="form-control" id="college_name_out_mh" name="mbbs_college_ind_mah" value="{{ old('mbbs_college_ind_mah', isset($collegeInfoData->mbbs_college_ind_mah) ? $collegeInfoData->mbbs_college_ind_mah : '') }}">
                  </div>
                  <div class="col-md-3 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_dev') }}:</label>
                  </div>
                  <div class="col-md-3  ">
                     <input type="text" class="form-control" id="uni_name_out_mh" name="mbbs_university_ind_mah" value="{{ old('mbbs_university_ind_mah', isset($collegeInfoData->mbbs_university_ind_mah) ? $collegeInfoData->mbbs_university_ind_mah : '') }}">
                  </div>
               </div>
               <div class="row form-group br-bt-1 {{ (isset($collegeInfoData->mbbs_college_type)) ? 'show' : 'hide' }} MedicalDetails">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.GovtClg_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.GovtClg_dev') }}</label>
                  </div>
                  <div class="col-md-3">
                     <select class="form-control {{ (isset($collegeInfoData->mbbs_college_type) && $collegeInfoData->mbbs_college_type!='AIIMS OR CENTRAL GOVT INSTITUTION') ? 'show' : 'hide' }}" name="mbbs_college_name"  id="collegeList" required autofocus>
                        <option  value="">SELECT</option>
                        @if(isset($collegeInfoData->mbbs_college_name))
                        <option  value="{{$collegeInfoData->mbbs_college_name}}" selected>{{$collegeInfoData->mbbs_college_name}}</option>
                        @endif
                     </select>
                  </div>
               </div>
               <div class="row form-group br-bt-1 ">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.MedicalCollege_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.CollegeInformation.fields.MedicalCollege_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control" name="aiee"  id="MedicalCollege" required autofocus>
                        <option value="">[SELECT]</option>
                        <option value="YES" {{ (isset($collegeInfoData->aiee) && $collegeInfoData->aiee==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($collegeInfoData->aiee) && $collegeInfoData->aiee==='NO') ? 'selected' : '' }}>NO</option>
                        <p class="error hide" id=" "></p>
                     </select>
                     <p class="error hide" id="MedicalCollegeError" ><font class="astr">*</font> Domicle Compulsory</p>
                  </div>
               </div>
            </fieldset>
            <fieldset class="form-fieldset mt-3">
               <legend>PREVIOUS ATTEMPT OF NEET PG</legend>
               <div class="row form-group br-bt-1 justify-content-center">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.CollegeInformation.fields.attemptedCandidate_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.CollegeInformation.fields.attemptedCandidate_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     @php (isset($collegeInfoData->neet_pg_attempt_year)) ? $arrOfNeetYr=explode(',',$collegeInfoData->neet_pg_attempt_year) : $arrOfNeetYr=array();@endphp
                     <select  id="neet_pg_attempt_year" value="" name="neet_pg_attempt_year[]" multiple="multiple" class="form-control h-auto select2">
                     <option value="NONE" {{ (isset($arrOfNeetYr) && in_array('NONE',$arrOfNeetYr)) ? 'selected' : '' }}>NONE</option>
                     <option value="2018" {{ (isset($arrOfNeetYr) && in_array('2018',$arrOfNeetYr)) ? 'selected' : '' }}>2018</option>
                     <option value="2019" {{ (isset($arrOfNeetYr) && in_array('2019',$arrOfNeetYr)) ? 'selected' : '' }}>2019</option>
                     <option value="2020" {{ (isset($arrOfNeetYr) && in_array('2020',$arrOfNeetYr)) ? 'selected' : '' }}>2020</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12 text-right mt-5">
                  <button type="submit" class="btn btn-success mb-3">Save And Next</button>
               </div>
            </fieldset>
         </form>
      </div>
   </div>
</div>
@endsection
@section('js')
<script>
   $(document).ready(function() {
      $('#collegeInfoForm').validate({
         rules: {
            'mbbs_passing_date' : {required: true,date: true},
            'mbbs_agg_per' : {required:true,number:true,minlength: 2,maxlength: 5},
            'mbbs_internship_date' : {required: true,date: true},
            'mci_reg_diploma': {required: true},
            'diploma_subject': {required: function(){return $('#DiplomaCourse').val()==='COMPLETED'; }},
            'degree_subject': {required: function(){return $('#DegreeCourse').val()==='COMPLETED'; }},
            'mci_reg_degree':{required: true},
            'mbbs_dc_in_mh_or_aiims':{required: true},
            'mbbs_college_type': {required: function(){return $('#MBBSDegree').val()==='YES'; }},
            'mbbs_college_name': {required: function(){return $('#MBBSDegree').val()==='YES'; }},
            'mbbs_college_outoff_ind_mah': {required: function(){return $('#MBBSDegree').val()==='NO'; }},
            'mbbs_college_ind_mah':{ required: function(){ return ($('#MBBSDegree').val()==='YES' && $('#CollegeType').val()==='AIIMS OR CENTRAL GOVT INSTITUTION') || ($('#MBBSDegree').val()==='NO'); }},
            'mbbs_university_ind_mah':{required: function(){ return ($('#MBBSDegree').val()==='YES' && $('#CollegeType').val()==='AIIMS OR CENTRAL GOVT INSTITUTION') || ($('#MBBSDegree').val()==='NO'); }},
            'aiee':{required: true},
            'neet_pg_attempt_year[]':{required: true}
         },   
         messages: {
            'mci_reg_diploma': {required: "Please Select Diploma Course Status"},
            'mci_reg_degree':  {required: "Please Select Degree Course Status"},
            'mbbs_passing_date' : {date: "Please Select Date of Passing."},
            'mbbs_agg_per' : {required: 'Enter valid B.D.S Aggregate Percentage'},
            'mbbs_internship_date' : {date: "Please enter valid date"},
            'diploma_subject':{required: "Please Select Subject of Diploma."},
            'degree_subject':{required: "Please Select Subject of Degree."},
            'mbbs_college_type':{required: "Please Select College Type"},
            'neet_pg_attempt_year[]':{required: "Please select previous PGM-CET NEET PG Attempt"}
         },
         submitHandler: function(form) {
            var data=serialiseData('collegeInfoForm');
            $.ajax({
                 url: "{{ route('collegeInfo.update', [$collegeInfoData->id])}}",
                 data: data,
                 type: 'PUT',
                      beforeSend: function() {
             var nriq = '{{$collegeInfoData->nriq}}';
            var domicle = '{{$collegeInfoData->domicle_maharashtra}}';
            var previous_mbbs_degree = $('#MBBSDegree').val();
             var outside_state = $('#MedicalCollege').val();
             var degree_course = $('#DegreeCourse').val();
             var mbbs_college_type = $('#mbbs_College_Type_No').val();
          
   
        if((nriq == 'NO' && domicle == '') && previous_mbbs_degree =='YES' ){ // not an nri,also don't have domicile then false
                // toastr.error('You don`t have domicle,sorry you can`t continue');
              $('#mbbs_dergee').html('You don`t have domicle,sorry you can`t continue,Please select no');
              $('#mbbs_dergee').show();
              return false;
            }else if(nriq == 'YES' && domicle == 'YES'){ // nri,no need of domicile so true
              $('#mbbs_dergee').html('You can`t select previous college from maharashtra,please select no');
              $('#mbbs_dergee').show();
              $('#MedicalCollegeError').show();
              return false;
            }else if(previous_mbbs_degree == 'YES' && outside_state == 'YES'){
               $('#MedicalCollegeError').html('You can only select one yes to 15% Quota or BDS College');
              $('#MedicalCollegeError').show();
               return false;
            }else if(previous_mbbs_degree == 'NO' && outside_state == 'NO'){
               $('#MedicalCollegeError').html('Please Select MBBS/BDS from situated in Maharashtra state/AIIMS/Central Gov Institution YES.');
               $('#MedicalCollegeError').show();
               return false;
            }
            else if(nriq == 'NO' && domicle == '' && outside_state == 'YES'){
               $('#MedicalCollegeError').html('You can`t apply for 15% Quota DENTAL college , Domicle is mandatory');
               $('#MedicalCollegeError').show();
               return false;
            }
            else if( outside_state == 'YES' && domicle == '' && nriq=='YES'){
              // toastr.error('You don`t have domicle,sorry you can`t continue,Please select no');
               $('#medical_college').html('You don`t have domicle,sorry you can`t continue,Please select no');
              $('#medical_college').show();
                return false;
            }
            if(nriq=='NO' && degree_course == 'COMPLETED' && previous_mbbs_degree == 'NO' && mbbs_college_type == 'DENTAL COLLEGE OUT OF INDIA'){
               $('#mbbs_college_type_error').html('Student Pursued college out of India is Not Eligible');
              $('#mbbs_college_type_error').show();
               return false;
            }else if((mbbs_college_type == 'DENTAL COLLEGE OUT OF INDIA' && nriq=='YES') ||(mbbs_college_type == 'DENTAL COLLEGE OUT OF INDIA' && nriq=='NO')  ){
               $('#mbbs_college_type_error').html('Student Pursued college out of India is Not Eligible');
              $('#mbbs_college_type_error').show();
               return false;
            }else if((nriq == 'NO' && domicle == 'YES' && previous_mbbs_degree == 'YES') || (nriq == 'YES' && domicle == '') || (nriq=='NO' && domicle == 'YES')) //indian ||  nri,no need of domicile so true  
            {
               return true;
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
                          window.location.replace("{{route('medicalCouncil.index')}}");
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
   $(document).on('change', '#CollegeType', function() {
    valueFlush(['collegeList','college_name_out_mh','uni_name_out_mh']);
    var CollegeType = $(this).val();
    if(CollegeType==''){
      $('.MedicalDetails').hide();
      $('#collegeList').hide();
      $('#collegeList').empty();
      $('#collegeList').append('<option value="">[SELECT]</option>');
      return false;
    }else if(CollegeType=='AIIMS OR CENTRAL GOVT INSTITUTION'){
      $('.clgDetails').show();
      $('.clgDetails').css('display', 'flex');
      $('#collegeList').hide();
      $('.MedicalDetails').hide();
      return false;
    }
    $('.clgDetails').hide();
    $('#collegeList').show();
    var url = '{{ route("collegeList.index", ":CollegeType") }}';
    url = url.replace(':CollegeType', CollegeType);
      $.ajax({
           url: url,
           type: 'get',
         
           success : function(data){
              $('.MedicalDetails').show();
              $('.MedicalDetails').css('display', 'flex');
              $('#collegeList').show();
              $('#collegeList').empty();
              $('#collegeList').append('<option value="">[SELECT]</option>');
              if(data.collegeData){
                  $.each(data.collegeData, function(key, val) {
                    $('#collegeList').append('<option value="'+key+'">'+val+'</option>');
                });
              }
          },
      
          error:function (response) {
              let data = response.responseJSON;
              toastr.error(data);
          }
       });
   });
   $(document).on('change', '#DiplomaCourse', function() {
      valueFlush(['SubofDiploma']);
      const DiplomaCourse = $(this).val();
      if (DiplomaCourse == "COMPLETED") {
          $('.DiplomaCourseDetails').css('display', 'flex');
          $('#DiplomaCourseError').hide();
      }
      else if (DiplomaCourse == "ADMITTED AND PURSUING") {
          $('#DiplomaCourseError').show();
          $('.DiplomaCourseDetails').css('display', 'flex');
      }
      else {
          $('.DiplomaCourseDetails').hide();
          $('#DiplomaCourseError').hide();
      }
   });
   $(document).on('change', '#DegreeCourse', function() {
      valueFlush(['degree_subject']);
      var DegreeCourse = $(this).val();
     if (DegreeCourse == "YES" || DegreeCourse == "NO") {
          //$('#DegreeCourseError').show();
          $('.DegreeCourseDetails').hide();

      }
      else {
          $('#DegreeCourseError').hide();
          $('#clgDetails').hide();
          $('.DegreeCourseDetails').css('display', 'flex');
      }
   });
   $(document).on('change', '#MBBSDegree', function() {
      valueFlush(['CollegeType','collegeList','mbbs_College_Type_No','college_name_out_mh','uni_name_out_mh']);
      $('.MedicalDetails').hide();
      $('.MBBSDegreeNo').hide();
      var MBBSDegree = $(this).val();
     if (MBBSDegree == "YES") {
          $('.CollegeTypeDetails').css('display', 'flex');
          $('.MBBSDegreeYes').show();
          $('.MBBSDegreeNo').hide();
           $('.clgDetails').hide();
      }else if(MBBSDegree == "NO"){
         $('.MBBSDegreeYes').hide();
         $('.MBBSDegreeNo').show();
         $('.clgDetails').css('display', 'flex');
      }
      else {
          $('.CollegeTypeDetails').hide();
          $('.MBBSDegreeYes').hide();
          $('.MBBSDegreeNo').hide();
          $('.clgDetails').hide();
          
      }
   });
   $(document).on('change', '#MedicalCollege', function() {
      var MedicalCollege = $(this).val();
     if (MedicalCollege == "YES") {
          $('#MedicalCollegeError').show();
   
      }
      else {
          $('#MedicalCollegeError').hide();
      }
   });
   function valueFlush(arryOfElements){
   $.each(arryOfElements, function(key, val) {
      $('#'+val).val('');
   });
   }
</script>
@include('include.user.UserCustomJs')
@endsection