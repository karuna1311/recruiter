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
                                <div class="col-md-6 mt-3 mb-3">
                                        <label >Employment (Present / Past) <span class="asrtick">*</span></label>
                                        <select class="form-control " name="employmentType" id="edittypeEmploymentLookupId">
                                        <option value="" selected>Select</option>
                                        <option {{ (isset($data->employmentType) && $data->employmentType==='PAST') ? 'selected' : '' }} value="PAST">PAST</option>
                                        <option {{ (isset($data->employmentType) && $data->employmentType==='PRESENT') ? 'selected' : '' }} value="PRESENT">PRESENT</option>
                                        </select>
                                </div>

                                <div class="col-md-6 mt-3 mb-3">
                                        <label >Whether selected from MPSC? <span class="asrtick">*</span></label>
                                        <select class="form-control " name="flgMpscSelection" id="editflgMpscSelection">
                                        <option value="">Select</option>
                                        <option {{ (isset($data->flgMpscSelection) && $data->flgMpscSelection==='YES') ? 'selected' : '' }} value="YES">YES</option>
                                        <option {{ (isset($data->flgMpscSelection) && $data->flgMpscSelection==='NO') ? 'selected' : '' }} value="NO">NO</option>
                                        </select>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6 mt-3 editpostNameLookupId {{ (isset($data->flgMpscSelection) && $data->flgMpscSelection == 'YES') ? 'show' : 'hide' }}">
                                        <label >Post Name <span class="asrtick">*</span></label>
                                        <select class="form-control select2" name="postNameLookupId" id="editpostNameLookupId">                                       
                                        @foreach($post_name as $key=>$value)
                                            <option {{ (isset($data->postNameLookupId) && $data->postNameLookupId==$key) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach                                      
                                        </select>
                                    </div>

                                <div class="col-md-6 mt-3">
                                    <label >Institution / Department / Organisation / Court <span class="asrtick">*</span></label>
                                    <input type="text" class="form-control" name="officeName" id="editofficeName" maxlength="500" value="{{ old('officeName',isset($data->officeName) ? $data->officeName : '' ) }}">
                                </div>
                           
                            </div>

                            <div class="row">
                                    <div class="col-md-6">
                                        <label style="float: left; width: 250px;">Is Office / Institution owned by Govt. of Maharashtra? <span class="asrtick">*</span></label>
                                            <select class="form-control select2" name="flgOfficeGovOwned">
                                            <option value="">Select</option>
                                            <option {{ (isset($data->flgMpscSelection) && $data->flgMpscSelection==='YES') ? 'selected' : '' }} value="YES">YES</option>
                                            <option {{ (isset($data->flgMpscSelection) && $data->flgMpscSelection==='NO') ? 'selected' : '' }} value="NO">NO</option>
                                            </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                    <label >Designation (Post Held) <span class="asrtick">*</span></label>
                                    <input type="text" class="form-control" name="designation" maxlength="200" value="{{ old('designation',isset($data->designation) ? $data->designation : '' ) }}">
                                 </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3" >
                                    <label >5.6&nbsp;Nature Of Job <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="jobNatureLookupId" id="editjobNatureLookupId">
                                    @foreach($job_nature as $key=>$value)
                                          <option {{ (isset($data->jobNatureLookupId) && $data->jobNatureLookupId== $key) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div>
                                 <div class="col-md-6 mb-3" >
                                    <label >Whether the post is Gazetted? <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="flgGazettedPost" id="editflgGazettedPostId">
                                       <option value="">Select</option>
                                       <option {{ (isset($data->flgGazettedPost) && $data->flgGazettedPost==='YES') ? 'selected' : '' }} value="YES">YES</option>
                                       <option {{ (isset($data->flgGazettedPost) && $data->flgGazettedPost==='NO') ? 'selected' : '' }} value="NO">NO</option>
                                    </select>
                                 </div>
                            </div>
                            <div class="row">                            
                            <div class="col-md-6 mb-3 edittypeGroupLookupId {{ (isset($data->flgGazettedPost) && $data->flgGazettedPost == 'YES') ? 'show' : 'hide' }}">
                                    <label>Group <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="typeGroup" id="edittypeGroupLookupId">
                                       <option value="">Select</option>
                                       <option {{ (isset($data->typeGroup) && $data->typeGroup==='Group A') ? 'selected' : '' }}  value="Group A"> Group A</option>
                                       <option {{ (isset($data->typeGroup) && $data->typeGroup==='Group B') ? 'selected' : '' }}  value="Group B">Group B</option>
                                    </select>
                                 </div>

                                 <div class="col-md-6 mb-3">
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
                                    <label style="margin-left: 15px;">5.8.1&nbsp;Appointment Letter No <span class="redColor">*</span></label>
                                    <input type="text" class="form-control" name="appointmentLetterNo" id="editappointmentLetterNo"  value="{{ old('appointmentLetterNo',isset($data->appointmentLetterNo) ? $data->appointmentLetterNo : '' ) }}">
                                 </div>

                                 <div class="col-md-4 mb-3 editappointmentContent">
                                    <label style="float: left;">5.8.2&nbsp;Letter Date <span class="redColor">*</span></label>
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
                                    <input type="text" class="form-control" name="expYears" id="editexpYears" disabled="" value="{{ old('expYears',isset($data->expYears) ? $data->expYears : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <label>Months</label>
                                    <input type="text" class="form-control" name="expMonths" id="editexpMonths" disabled="" value="{{ old('expMonths',isset($data->expMonths) ? $data->expMonths : '' ) }}">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <label>Days</label>
                                    <input type="text" class="form-control" name="expDays" id="editexpDays" disabled="" value="{{ old('expDays',isset($data->expDays) ? $data->expDays : '' ) }}">
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
                           