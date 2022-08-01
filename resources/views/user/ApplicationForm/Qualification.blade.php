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
          <form>
                           <fieldset class="form-fieldset">
                              <legend>Qualifications Information <span class="text-muted">शैक्षणिक माहिती</span></legend>
                              <div class="row">
                                 <div class="col-md-3 mb-1">
                                    <label >Qualification Type <br>पात्रता प्रकार</label>
                                    <select class="form-control select2" name="qualificationtype" id="qualificationtype">
                                       <option value="Select">Select Qualification Type</option>                        
                                       @foreach($qualification as $value)
                                       <option value="{{ $value->qualificationtypecode }}"> {{ $value->qualificationtypename }}</option>   
                                       @endforeach                                       
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >Name of Qualification <br>पात्रतेचे नाव</label>
                                    <select class="form-control" name="qualificationname" id="qualificationname"></select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >Subject / Stream / Branch<br>विषय/प्रवाह/शाखा</label>
                                    <select class="form-control" name="subjectLookupId" id="subjectLookupId" ></select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >State<br>राज्य</label>
                                    <select class="form-control select2" name="statecode" id="statecode">
                                       @foreach($stateData as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach
                                    </select>                                    
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="universitycode" >Board / University<br>मंडळ / विद्यापीठ</label>
                                    <select id="universitycode" class="form-control" name="universitycode" id="universitycode"></select>
                                 </div>
                                 <div class="col-md-3"><label >Qualification Status <br>पात्रता स्थिती</label>
                                    <select class="form-control" name="typeResult" id="typeResult" ></select>
                                 </div>
                                 <div class="col-md-3">
                                    <label >Date of qualification completion<br>पात्रता पूर्ण होण्याची तारीख</label>
                                    <input type="date"  name="DateofQualification" id="DateofQualification" class="form-control" value="">   
                                 </div>
                                 <div class="col-md-3 mt-3 mb-1">
                                    <label >Attempts<br>प्रयत्न</label>
                                    <input type="text" class="form-control" name="attempts" id="attempts" >
                                 </div>
                                 <div class="col-md-6 mt-3 mb-1">
                                    <label >Percentage / CGPA (For Grade add respective percentage value)<br>टक्केवारी / CGPA (श्रेणीसाठी संबंधित टक्केवारी मूल्य जोडा)</label>
                                    <input type="text" class="form-control" name="percentageGrade" id="percentageGrade">
                                 </div>
                                 <div class="col-md-3 mt-3 mb-1">
                                    <label >Number of academic months<br>शैक्षणिक महिन्यांची संख्या</label>
                                    <input type="text" class="form-control" name="courseDurationMonths" id="courseDurationMonths">
                                 </div>
                                 <div class="col-md-3  mb-1">
                                    <label >Class / Grade<br>वर्ग / श्रेणी</label>
                                    <select class="form-control" name="classGradeLookupId" id="classGradeLookupId"></select>
                                 </div>
                                 <div class="col-md-3 mb-1">
                                    <label >Mode<br>मोड</label>
                                    <select class="form-control" name="modeLookupId" id="modeLookupId"></select>
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
                                    <tr>
                                       <td>1</td>
                                       <td>SSC</td>
                                       <td>SSC</td>
                                       <td></td>
                                       <td>State Board</td>
                                       <td>01/04/2010</td>
                                       <td>1</td>
                                       <td>56</td>
                                       <td>2</td>
                                       <td>Second Class</td>
                                       <td>Traditional / Regular</td>
                                       <td class="word-break">a</td>
                                       <td class="word-break">b</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </fieldset>
                           <div class="row form-group  mt-3 ">
                              <div class="col-md-6 text-right"> 
                                 <button type="button" class="btn btn-success mb-1">Save And Next</button>
                              </div>
                           </div>
                        </form>
      </div>
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
     $(document).ready(function() {
         $(document).on('change','#qualificationtype',function() {
   //  valueFlush(['collegeList','college_name_out_mh','uni_name_out_mh']);
    var Qualificationtype = $(this).val();
   
    var url = '{{ route("services.getQualificationName", ":Qualificationtype") }}';
    url = url.replace(':Qualificationtype', Qualificationtype);
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
     });
   </script>
@include('include.user.UserCustomJs')
@endsection