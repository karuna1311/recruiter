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
                              <legend>Experiance Information <span class="text-muted">शैक्षणिक माहिती</span></legend>
                              <div class="row mt-3" >
                                 <div class="col-md-3 mt-3 mb-3">
                                    <label >Employment (Present / Past) <span class="asrtick">*</span></label>
                                    <select class="form-control " name="typeEmploymentLookupId" id="typeEmploymentLookupId">
                                       <option value="" selected>Select</option>
                                       <option value="PAST">PAST</option>
                                       <option value="PRESENT">PRESENT</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3">
                                    <label >Whether selected from MPSC? <span class="asrtick">*</span></label>
                                    <select class="form-control " name="flgMpscSelection" id="flgMpscSelection">
                                       <option value="">Select</option>
                                       <option value="YES">YES</option>
                                       <option value="NO">NO</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3 postNameLookupId">
                                    <label >Post Name <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="postNameLookupId" id="postNameLookupId">                                       
                                       @foreach($post_name as $key=>$value)
                                          <option value="{{ $value->id }}">{{ $value }}</option>
                                       @endforeach 
                                     
                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3"><label >Institution / Department / Organisation / Court <span class="asrtick">*</span></label><input type="text" class="form-control" name="officeName" maxlength="500" value=""></div>
                                 <div class="col-md-3">
                                    <label style="float: left; width: 250px;">Is Office / Institution owned by Govt. of Maharashtra? <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="flgOfficeGovOwned">
                                       <option value="">Select</option>
                                       <option value="YES">YES</option>
                                       <option value="NO">NO</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label >Designation (Post Held) <span class="asrtick">*</span></label>
                                    <input type="text" class="form-control" name="designation" maxlength="200" value="">
                                 </div>

                                 <div class="col-md-3 mb-3" >
                                    <label >5.6&nbsp;Nature Of Job <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="jobNatureLookupId" id="jobNatureLookupId">
                                    @foreach($job_nature as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-3" >
                                    <label >Whether the post is Gazetted? <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="flgGazettedPost" id="flgGazettedPost">
                                       <option value="">Select</option>
                                       <option value="YES">YES</option>
                                       <option value="NO">NO</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-3 mb-3 typeGroupLookupId">
                                    <label>Group <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="typeGroupLookupId">
                                       <option value="">Select</option>
                                       <option value="1"> Group A</option>
                                       <option value="2">Group B</option>
                                    </select>
                                 </div>

                                 <div class="col-md-3 mb-3">
                                    <label >Nature Of Appointment <span class="asrtick">*</span></label>
                                    <select class="form-control " name="apointmentNatureLookupId" id="apointmentNatureLookupId">
                                    @foreach($appointment_nature as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div>

                                 <div class="col-md-3 mb-3 fullTimeLookup">
                                    <label>Full Time / Other</label>
                                    <select class="form-control" name="fullTimeLookupId" id="fullTimeLookupId">
                                       <option value="">Select</option>
                                       <option value="FULL TIME">FULL TIME</option>
                                       <option value="OTHERWISE">OTHERWISE</option>
                                    </select>
                                 </div>

                                 <div class="col-md-3 mb-3 appointmentContent">
                                    <label style="margin-left: 15px;">5.8.1&nbsp;Appointment Letter No <span class="redColor">*</span></label>
                                    <input type="text" class="form-control" name="appointmentLetterNo" id="appointmentLetterNo"  value="">
                                 </div>

                                 <div class="col-md-3 mb-3 appointmentContent">
                                    <label style="float: left;">5.8.2&nbsp;Letter Date <span class="redColor">*</span></label>
                                    <input type="date" class="form-control" name="letterDate" id="letterDate">
                                 </div>


                              </div>

                              <div class="row">
                                 <div class="col-md-3 mb-3">
                                    <label>Pay Band / Pay Scale / Professional Charge <span class="astrick">*</span>
                                    </label>
                                    <input type="text" class="form-control" maxlength="20" name="payScale" id="payScale" >
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label>Grade Pay</label>
                                    <input type="text" class="form-control" maxlength="6" name="gradePay" id="gradePay" >
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label>Basic Pay / Minimum Professional Charge <span class="astrick">*</span></label>
                                    <input type="text" class="form-control" maxlength="6" name="basicPay" id="basicPay" >
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label>Monthly Gross Salary / Income <span class="astrick">*</span></label>
                                    <input type="text" class="form-control" maxlength="6" name="monthlyGrossSalary" id="monthlyGrossSalary" >
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-md-3 mb-2">
                                    <label>From Date <span class="astrick">*</span></label>
                                    <input type="date" class="form-control" name="fromDate" id="fromDate">
                                 </div>
                                 <div class="col-md-3 mb-2 toDate">
                                    <label>To Date <span class="asrtick">*</span></label>
                                    <input type="date" class="form-control"  name="toDate" id="toDate">
                                 </div>
                                 <div class="col-md-1 mb-3">
                                    <label>Years</label>
                                    <input type="text" class="form-control" name="expYears" id="expYears" disabled="" value="">
                                 </div>
                                 <div class="col-md-1 mb-3">
                                    <label>Months</label>
                                    <input type="text" class="form-control" name="expMonths" id="expMonths" disabled="" value="">
                                 </div>
                                 <div class="col-md-1 mb-3">
                                    <label>Days</label>
                                    <input type="text" class="form-control" name="expDays" id="expDays" disabled="" value="">
                                 </div>
                              </div>

                           </fieldset>
                           <br>
                           <fieldset class="form-fieldset">
                              <table class="table tableauto table-bordered table-responsive w-100" style="margin: 0px; position: relative; right: 15px;">
                                 <thead class="thead-light">
                                    <tr>
                                       <th>Sr No</th>
                                       <th>Institution / Department / Organisation / Court</th>
                                       <th>Designation (Post Held)</th>
                                       <th>Nature Of Appointment</th>
                                       <th>Nature Of Job</th>
                                       <th>Full Time / Other</th>
                                       <th>Pay Band / Pay Scale / Professional Charge</th>
                                       <th>Grade Pay</th>
                                       <th>Monthly Gross Salary / Income</th>
                                       <th>From Date</th>
                                       <th>To Date</th>
                                       <th>Years</th>
                                       <th>Months</th>
                                       <th>Days</th>
                                       <th>Whether selected from MPSC?</th>
                                    </tr>
                                 </thead>
                                 <tbody style="font-size: 12px;">
                                    <tr>
                                       <td>1</td>
                                       <td >smb1</td>
                                       <td >o</td>
                                       <td>Permanent</td>
                                       <td>Teaching</td>
                                       <td></td>
                                       <td>as</td>
                                       <td>21</td>
                                       <td>21</td>
                                       <td>02/12/2020</td>
                                       <td></td>
                                       <td>0</td>
                                       <td>8</td>
                                       <td>23</td>
                                       <td>No</td>
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
         function valueFlush(arryOfElements){
     $.each(arryOfElements, function(key, val) {
         $('#'+val).val('');
     });
   }
//
   $(document).on('change', '#typeEmploymentLookupId', function() {
    valueFlush(['toDate']); 
    var typeEmploymentLookupId = $(this).val();
    if (typeEmploymentLookupId == "PRESENT") {
        $('.toDate').hide();
    } else {
        $('.toDate').show();
    }
   });

   //flgMpscSelection
   $(document).on('change', '#flgMpscSelection', function() {
    valueFlush(['postNameLookupId']); 
    var flgMpscSelection = $(this).val();
    if (flgMpscSelection == "NO") {
        $('.postNameLookupId').hide();
    } else {
        $('.postNameLookupId').show();
    }
   });

   //flgGazettedPost
   $(document).on('change', '#flgGazettedPost', function() {
    valueFlush(['typeGroupLookupId']); 
    var flgGazettedPost = $(this).val();
    if (flgGazettedPost == "NO") {
        $('.typeGroupLookupId').hide();
    } else {
        $('.typeGroupLookupId').show();
    }
   });
   //
    $(document).on('change', '#apointmentNatureLookupId', function() {
    valueFlush(['appointmentLetterNo','letterDate']); 
    var apointmentNatureLookupId = $(this).val();
    console.log(apointmentNatureLookupId);
    if (apointmentNatureLookupId == '269' || apointmentNatureLookupId == "CONTRACT BASIS" || apointmentNatureLookupId == "PERMANENT" || apointmentNatureLookupId == "TEMPORARY") {
        $('.appointmentContent').show();
    } 
    else if(apointmentNatureLookupId == "269")
    {
      $('.fullTimeLookup').show();
    }
    else {
        $('.appointmentContent').hide();
        $('.fullTimeLookup').hide();
    }
   });
      </script>
@include('include.user.UserCustomJs')
@endsection