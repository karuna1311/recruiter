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
          <form id="qualificationform" method="POST">
            @csrf
                           <fieldset class="form-fieldset">
                              <legend>Qualifications Information <span class="text-muted">शैक्षणिक माहिती</span></legend>
                              <div class="row">
                                 <div class="col-md-3 mb-1">
                                    <label for="qualificationtype">Qualification Type <br>पात्रता प्रकार</label>
                                    <select class="form-control select2" name="qualificationtype" id="qualificationtype">
                                       <option value="Select">Select Qualification Type</option>                        
                                       @foreach($qualification as $value)
                                       <option value="{{ $value->qualification_type_code }}"> {{ $value->qualification_type_name }}</option>   
                                       @endforeach                                       
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label for="qualificationname">Name of Qualification <br>पात्रतेचे नाव</label>
                                    <select class="form-control select2" name="qualificationname" id="qualificationname"></select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label for="subject">Subject / Stream / Branch<br>विषय/प्रवाह/शाखा</label>
                                    <select class="form-control select2" name="subject" id="subjectId" ></select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label for="state">State<br>राज्य</label>
                                    <select class="form-control select2" name="state" id="statecode">
                                       @foreach($stateData as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach
                                    </select>                                    
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="universitycode" >Board / University<br>मंडळ / विद्यापीठ</label>
                                    <select id="universitycode" class="form-control select2" name="university" id="universitycode"></select>
                                 </div>
                                 <div class="col-md-3"><label >Qualification Status <br>पात्रता स्थिती</label>
                                    <select class="form-control select2" name="typeResult" id="typeResult" >
                                       <option value="">SELECT</option>
                                       <option value="PASSED">Passed</option>
                                       <option value="APPEARED">Appeared</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3">
                                    <label >Date of qualification completion<br>पात्रता पूर्ण होण्याची तारीख</label>
                                    <input type="date"  name="doq" id="DateofQualification" class="form-control" value="">   
                                 </div>
                                 <div class="col-md-3 mt-3 mb-1">
                                    <label >Attempts<br>प्रयत्न</label>
                                    <input type="text" class="form-control" name="attempts" id="attempts" >
                                 </div>
                                 <div class="col-md-6 mt-3 mb-1">
                                    <label >Percentage / CGPA (For Grade add respective percentage value)<br>टक्केवारी / CGPA (श्रेणीसाठी संबंधित टक्केवारी मूल्य जोडा)</label>
                                    <input type="text" class="form-control" name="percentage" id="percentageGrade">
                                 </div>
                                 <div class="col-md-3 mt-3 mb-1">
                                    <label >Number of academic months<br>शैक्षणिक महिन्यांची संख्या</label>
                                    <input type="text" class="form-control" name="courseDurations" id="courseDurationMonths">
                                 </div>
                                 <div class="col-md-3  mb-1">
                                    <label >Class / Grade<br>वर्ग / श्रेणी</label>
                                    <select class="form-control select2" name="classGrade" id="classGradeLookupId">
                                    @foreach($grade as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >Mode<br>मोड</label>
                                    <select class="form-control select2" name="mode" id="modeLookupId">
                                    @foreach($mode as $key=>$value)                                       
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >Compulsory Subjects<br>अनिवार्य विषय</label>
                                    <input type="text" class="form-control" name="compulsorySubjects" id="compulsorySubjects">
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >Optional Subjects<br>ऐच्छिक विषय</label>
                                    <input type="text" class="form-control" name="optionalSubjects" id="optionalSubjects">
                                 </div>
                              </div>
                           </fieldset>
                           <br>
                           <fieldset class="form-fieldset">
                              <table class="table tableauto table-bordered table-responsive w-100">
                                 <thead class="thead-light">
                                    <tr>
                                       <th >Sr No</th>
                                       <th >Qualification Type</th>
                                       <th >Name of Qualification</th>
                                       <th >Subject / Stream / Branch</th>
                                       <th >Board / University</th>
                                       <th >Date of qualification completion</th>
                                       <th >Attempts</th>
                                       <th >Percentage / CGPA (For Grade add respective percentage value)</th>
                                       <th >Number of academic months</th>
                                       <th >Class / Grade</th>
                                       <th >Mode</th>
                                       <th >Compulsory Subjects</th>
                                       <th >Optional Subjects</th>
                                    
                                    </tr>
                                 </thead>
                                 <tbody style="font-size: 12px;">
                                 @foreach($user_qualification as $value)
                                    <tr>
                                       <td>{{ $value->id }}</td>
                                       <td>{{ !empty($value->qualification_type) ? $value->qualification_type : '-'}}</td>
                                       <td>{{ !empty($value->qualification_name) ? $value->qualification_name : '-'}}</td>
                                       <td>{{ !empty($value->subject_name) ? $value->subject_name : '-'}}</td>
                                       <td>{{ !empty($value->university_name) ? $value->university_name : '-'}}</td>                                    
                                       <td>{{ !empty($value->doq) ? $value->doq : '-'}}</td>                                    
                                       <td>{{ !empty($value->attempts) ? $value->attempts : '-'}}</td>                                    
                                       <td>{{ !empty($value->percentage) ? $value->percentage : '-'}}</td>                                    
                                       <td>{{ !empty($value->courseDurations) ? $value->courseDurations : '-'}}</td>                                    
                                       <td>{{ !empty($value->class) ? $value->class : '-'}}</td>                                    
                                       <td>{{ !empty($value->mode) ? $value->mode : '-'}}</td>                                    
                                       <td>{{ !empty($value->compulsorySubjects) ? $value->compulsorySubjects : '-'}}</td>                                    
                                       <td>{{ !empty($value->optionalSubjects) ? $value->optionalSubjects : '-'}}</td>
                                    </tr>
                                 @endforeach
                                  
                                 </tbody>
                              </table>
                           </fieldset>
                           <div class="row form-group  mt-3 ">
                              <div class="col-md-6 text-right"> 
                                 <button type="submit" class="btn btn-success mb-1">Save And Next</button>
                              </div>
                           </div>
                        </form>
      </div>
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
 
 
      $(document).on('change','#qualificationtype',function() {
   
         var Qualificationtype = $(this).val();
         var encode = btoa(Qualificationtype);
         
         var url = '{{ route("services.getQualificationName", ":Qualificationtype") }}';
         url = url.replace(':Qualificationtype', encode);
            $.ajax({
               url: url,
               type: 'get',
               success : function(data){

                  $('#qualificationname').empty();
                  if(data){
                        $.each(data, function(key, val) { 
                        $('#qualificationname').append('<option value="'+key+'">'+val+'</option>');
                     });
                  }
               },
               error:function (response) {
                  let data = response.responseJSON;
                  toastr.error(data);
               }
            });
         });
      

   $(document).on('change','#qualificationname',function() {
         var Qualificationname = $(this).val();
         var encode = btoa(Qualificationname);
         
         var url = '{{ route("services.getSubject", ":Qualificationname") }}';
         url = url.replace(':Qualificationname', encode);
            $.ajax({
               url: url,
               type: 'get',
               success : function(data){

                  $('#subjectId').empty();
                  if(data){
                        $.each(data, function(key, val) {
                        $('#subjectId').append('<option value="'+key+'">'+val+'</option>');
                     });
                  }
               },
               error:function (response) {
                  let data = response.responseJSON;
                  toastr.error(data);
               }
            });
   });


   $(document).on('change','#statecode',function() {

   var state = $(this).val();
   var encode = btoa(state);
         
         var url = '{{ route("services.getUniversityName", ":state") }}';
         url = url.replace(':state', encode );
            $.ajax({
               url: url,
               type: 'get',
               success : function(data){
                  $('#universitycode').empty();
                  if(data){
                        $.each(data, function(key, val) {
                        $('#universitycode').append('<option value="'+key+'">'+val+'</option>');
                     });
                  }
               },
               error:function (response) {
                  let data = response.responseJSON;
                  toastr.error(data);
               }
            });
   });
   $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("#qualificationform").validate({
    // Specify validation rules
    rules: {
      qualificationtype : "required",
      qualificationname : "required",    
      state : "required",
      university : "required",
      typeResult : "required",
      doq:{
                    required: function () { return $('#typeResult').val()==='PASSED';},
         },
         attempts:{
                    required: function () { return $('#typeResult').val()==='PASSED';},
         },
         percentage:{
                    required: function () { return $('#typeResult').val()==='PASSED';},
         },
         courseDurations:{
                    required: function () { return $('#typeResult').val()==='PASSED';},
         },
         classGrade:{
                    required: function () { return $('#typeResult').val()==='PASSED';},
         },
         mode:{
                    required: function () { return $('#typeResult').val()==='PASSED';},
         },
    },
    // Specify validation error messages
    messages: {
      qualificationtype : {
                     required:"Please select Qualification Type"
                  },
                  qualificationname : {
                     required:"Please select Qualification Name"
                  },
                  state : {
                     required:"Please select State"
                  },
                  university : {
                     required:"Please select University"
                  },
                  typeResult : {
                     required:"Please select Qualification Status"
                  },
                  attempts : {
                     required:"Please enter your attempts"
                  },
                  percentage : {
                     required:"Please enter your percentage"
                  },
                  courseDurations : {
                     required:"Please enter your course duration"
                  },
                  classGrade : {
                     required:"Please select Class/Grade Type"
                  },
                  mode : {
                     required:"Please select Mode"
                  },   
                  doq : {
                     required:"Please select Date of Qualification Passed"
                  }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      $.ajax({
                     url: "{{ route('qualification.store')}}",
                     data: $(form).serialize(),
                     type: 'POST',
                     success : function(data){
                        if (data.ValidatorErrors) {
                          $.each(data.ValidatorErrors, function(index, jsoNObject) {
                            $.each(jsoNObject, function(key, val) {
                                toastr.error(val);
                            });
                            return false;
                          });
                        }
                        if (data.status) {
                          if(data.status==='error') toastr.error(data.data);
                          else if(data.status==='success'){
                             toastr.success(data.data);
                             window.location.reload();
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