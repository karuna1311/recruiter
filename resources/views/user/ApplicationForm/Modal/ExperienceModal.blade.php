<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-modal-label">Edit Experience</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attachment-body-content">
                    <div class="card mb-0">
                     
                        <form role="form" id="updateexperienceform" method="PUT" action="{{ route('experience.update',[base64_encode($data->id)]) }}" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                        <label >Employment (Present / Past) <span class="asrtick">*</span></label>
                                        <select class="form-control " name="employmentType" id="edittypeEmploymentLookupId">
                                        <option value="" selected>Select</option>
                                        <option {{ (isset($data->employmentType) && $data->employmentType==='PAST') ? 'selected' : '' }} value="PAST">PAST</option>
                                        <option {{ (isset($data->employmentType) && $data->employmentType==='PRESENT') ? 'selected' : '' }} value="PRESENT">PRESENT</option>
                                        </select>
                                </div>

                                <div class="col-md-6 mt-3 ">
                                    <label>
                                       Select Post Name/ Designation <span class="asrtick">*</span>
                                    </label>
                                    <select class="form-control" name="postNameLookupId" id="editpostNameLookupId">                                       
                                    @foreach($post_name as $key=>$value)
                                       <option {{ (isset($data->postNameLookupId) && $data->postNameLookupId==$key) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach                                      
                                    </select>
                                 </div>           
                            </div>

                            <div class="row">
                              <div class="col-md-6 editdesignation hide">
                                 <label >Designation <span class="asrtick">*</span></label>
                                 <input type="text" class="form-control" name="designation" maxlength="200">
                              </div>

                                <div class="col-md-6">
                                    <label >Institution / Department / Organisation <span class="asrtick">*</span></label>
                                    <input type="text" class="form-control" name="officeName" id="editofficeName" maxlength="500" value="{{ old('officeName',isset($data->officeName) ? $data->officeName : '' ) }}">
                                </div>

                           
                            </div>

                            <div class="row">                                 
                                 <div class="col-md-6" >
                                    <label >Nature Of Job <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="jobNatureLookupId" id="editjobNatureLookupId">
                                    @foreach($job_nature as $key=>$value)
                                          <option {{ (isset($data->jobNatureLookupId) && $data->jobNatureLookupId== $key) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div>

                                 <div class="col-md-6">
                                    <label >Nature Of Appointment <span class="asrtick">*</span></label>
                                    <select class="form-control " name="apointmentNatureLookupId" id="editapointmentNatureLookupId" onchange="apointmentNaturechange($(this).val(),'yes')">
                                    @foreach($appointment_nature as $key=>$value)
                                          <option {{ (isset($data->apointmentNatureLookupId) && $data->apointmentNatureLookupId== $key) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div> 
                           </div>
          
                            <div class="row">                               
                            <div class="col-md-4 mb-3 editfullTimeLookup">
                                    <label>Full Time / Other</label>
                                    <select class="form-control" name="time" id="editfullTimeLookupId">
                                       <option value="">Select</option>
                                       <option  {{ (isset($data->time) && $data->time==='FULL TIME') ? 'selected' : '' }} value="FULL TIME">FULL TIME</option>
                                       <option  {{ (isset($data->time) && $data->time==='OTHERWISE') ? 'selected' : '' }} value="OTHERWISE">OTHERWISE</option>
                                    </select>
                                 </div>

                                 <div class="col-md-4 mb-3 editappointmentContent">
                                    <label style="margin-left: 15px;">Appointment Letter No <span class="redColor">*</span></label>
                                    <input type="text" class="form-control" name="appointmentLetterNo" id="editappointmentLetterNo"  value="{{ old('appointmentLetterNo',isset($data->appointmentLetterNo) ? $data->appointmentLetterNo : '' ) }}">
                                 </div>

                                 <div class="col-md-4 mb-3 editappointmentContent">
                                    <label style="float: left;">Letter Date <span class="redColor">*</span></label>
                                    <input type="date" class="form-control" name="letterDate" id="editletterDate" value="{{ old('letterDate',isset($data->letterDate) ? $data->letterDate : '' ) }}">
                                 </div>
                            </div>
                            <div class="row">                          
                            <div class="col-md-4 mb-3">
                                    <label>Pay Band / Pay Scale / Professional Charge <span class="astrick">*</span>
                                    </label>
                                    <input type="text" class="form-control" maxlength="20" name="payScale" id="editpayScale" value="{{ old('payScale',isset($data->payScale) ? $data->payScale : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <label>Grade Pay</label>
                                    <input type="text" class="form-control" maxlength="6" name="gradePay" id="editgradePay" value="{{ old('gradePay',isset($data->gradePay) ? $data->gradePay : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <label>Basic Pay / Minimum Professional Charge <span class="astrick">*</span></label>
                                    <input type="text" class="form-control" maxlength="6" name="basicPay" id="editbasicPay" value="{{ old('basicPay',isset($data->basicPay) ? $data->basicPay : '' ) }}" >
                                 </div>
                               
                            </div>
                            <div class="row">
                                  <div class="col-md-4 mb-3">
                                    <label>Monthly Gross Salary / Income <span class="astrick">*</span></label>
                                    <input type="text" class="form-control" maxlength="6" name="monthlyGrossSalary" id="editmonthlyGrossSalary" value="{{ old('monthlyGrossSalary',isset($data->monthlyGrossSalary) ? $data->monthlyGrossSalary : '' ) }}">
                                 </div>
                            <div class="col-md-4 mb-2">
                                    <label>From Date <span class="astrick">*</span></label>
                                    <input type="date" class="form-control" name="fromDate" id="editfromDate" value="{{ old('fromDate',isset($data->fromDate) ? $data->fromDate : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-2 edittoDate {{ (isset($data->employmentType) && $data->employmentType == 'PAST') ? 'show' : 'hide' }}">
                                    <label>To Date <span class="asrtick">*</span></label>
                                    <input type="date" class="form-control"  name="toDate" id="edittoDate" value="{{ old('toDate',isset($data->toDate) ? $data->toDate : '' ) }}">
                                 </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4 mb-3">
                                    <label>Years</label>
                                    <input type="text" class="form-control" name="expYears" readonly id="editexpYears"  value="{{ old('expYears',isset($data->expYears) ? $data->expYears : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <label>Months</label>
                                    <input type="text" class="form-control" name="expMonths" readonly id="editexpMonths"  value="{{ old('expMonths',isset($data->expMonths) ? $data->expMonths : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <label>Days</label>
                                    <input type="text" class="form-control" name="expDays" readonly id="editexpDays"  value="{{ old('expDays',isset($data->expDays) ? $data->expDays : '' ) }}">
                                 </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="editexperiencesubmit" class="btn btn-warning">Update Experience</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
         
   $('#editfromDate,#edittoDate').on('change',function()
   {
      var employment = $('#edittypeEmploymentLookupId').val();
      // console.log(employment);
      let fromDate      = $('#editfromDate').val();
            if(employment=='PRESENT')
            {
               valueFlush(['editexpYears','editexpMonths','editexpDays']);
               let  today	= new Date();

               let  dd 		      = String(today.getDate()).padStart(2, '0');
               let  mm 		      = String(today.getMonth() + 1).padStart(2, '0'); //janvier = 0
               let  yyyy 		   = today.getFullYear();
               let toDate        = yyyy+'-'+mm+'-'+dd;
               var secondDate = moment(toDate,'YYYY-MM-DD');

            }else{
               valueFlush(['editexpYears','editexpMonths','editexpDays']);
               var toDate = $('#edittoDate').val();
               var secondDate = moment(toDate, 'YYYY-MM-DD');
               // console.log(secondDate);             
            }
       
      var firstDate = moment(fromDate, 'YYYY-MM-DD');
      var years = secondDate.diff(firstDate, 'year');
      firstDate.add(years, 'years');
      var months = secondDate.diff(firstDate, 'months');
      firstDate.add(months, 'months');
      var days = secondDate.diff(firstDate, 'days');
      if(isNaN(years)){years=0;}
      if(isNaN(months)){months=0;}
      if(isNaN(days)){days=0;}
            // console.log(years);
            // console.log(months);
            // console.log(days);
      $('#updateexperienceform #editexpYears').val(years);
      $('#updateexperienceform #editexpMonths').val(months);
      $('#updateexperienceform #editexpDays').val(days);
   });

   // edit modal
   $(document).on('change', '#edittypeEmploymentLookupId', function() {
      valueFlush(['edittoDate']); 
      var typeEmploymentLookupId = $(this).val();
      if (typeEmploymentLookupId == "PRESENT") {
         $('.edittoDate').hide();
      } else {
         $('.edittoDate').show();
      }
   });

   $('#editpostNameLookupId').on('change',function(){      
      value = $(this).val();
      // console.log(value);
      if(value==433){
         $('.editdesignation').show();
      }else{
         $('.editdesignation').hide();
      }
   });

         </script>
                           