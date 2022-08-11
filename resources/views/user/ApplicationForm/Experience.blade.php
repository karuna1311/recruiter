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
         <form id="experienceForm">
            @csrf
                           <fieldset class="form-fieldset">
                              <legend>Experiance Information <span class="text-muted">अनुभव माहिती</span></legend>
                              <div class="row mt-3" >
                                 <div class="col-md-3 mt-3 mb-3">
                                    <label >Employment (Present / Past) <span class="asrtick">*</span></label>
                                    <select class="form-control " name="employmentType" id="typeEmploymentLookupId">
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
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                      
                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3"><label >Institution / Department / Organisation / Court <span class="asrtick">*</span></label>
                                 <input type="text" class="form-control" name="officeName" maxlength="500" value=""></div>
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
                                    <select class="form-control" name="flgGazettedPost" id="flgGazettedPostId">
                                       <option value="">Select</option>
                                       <option value="YES">YES</option>
                                       <option value="NO">NO</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-3 mb-3 typeGroupLookupId">
                                    <label>Group <span class="asrtick">*</span></label>
                                    <select class="form-control" name="typeGroup" id="typeGroupLookupId">
                                       <option value="">Select</option>
                                       <option value="Group A"> Group A</option>
                                       <option value="Group B">Group B</option>
                                    </select>
                                 </div>

                                 <div class="col-md-3 mb-3">
                                    <label >Nature Of Appointment <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="apointmentNatureLookupId" onchange="apointmentNaturechange($(this).val())" id="apointmentNatureLookupId">
                                    @foreach($appointment_nature as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div>

                                 <div class="col-md-3 mb-3 fullTimeLookup">
                                    <label>Full Time / Other</label>
                                    <select class="form-control" name="time" id="fullTimeLookupId">
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
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover datatable datatable-experience">                              
                                 <thead class="thead-light">
                                    <tr>
                                       <th></th>
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
                                       <!-- <th>Years</th>
                                       <th>Months</th>
                                       <th>Days</th> -->
                                       <th>Whether selected from MPSC?</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody style="font-size: 12px;">
                                 @foreach($user_experience as $value)
                                    <tr>
                                       <td></td>
                                       <td>{{ $value->id }}</td>
                                       <td>{{ !empty($value->officeName) ? $value->officeName : '-'}}</td>
                                       <td>{{ !empty($value->designation) ? $value->designation : '-'}}</td>
                                       <td>{{ !empty($value->appointment) ? $value->appointment : '-'}}</td>
                                       <td>{{ !empty($value->job_nature) ? $value->job_nature : '-'}}</td>                                    
                                       <td>{{ !empty($value->time) ? $value->time : '-'}}</td>                                    
                                       <td>{{ !empty($value->payScale) ? $value->payScale : '-'}}</td>                                    
                                       <td>{{ !empty($value->gradePay) ? $value->gradePay : '-'}}</td>                                                                                                           
                                       <td>{{ !empty($value->monthlyGrossSalary) ? $value->monthlyGrossSalary : '-'}}</td>                                    
                                       <td>{{ !empty($value->fromDate) ? $value->fromDate : '-'}}</td>                                    
                                       <td>{{ !empty($value->toDate) ? $value->toDate : '-'}}</td>                                    
                                       <td>{{ !empty($value->flgMpscSelection) ? $value->flgMpscSelection : '-'}}</td>
                                       <td>
                                                <a type="button" class="btn btn-xs btn-info"
                                                data-bs-toggle="modal"  onclick="editExperience(this)"
                                                   action="{{ route('experience.edit', base64_encode($value->id)) }}"
                                                   >
                                                    {{ trans('global.edit') }}
                                                </a>   
                                                                      
                                       </td>

                                                <!-- <td>{{ !empty($value->compulsorySubjects) ? $value->compulsorySubjects : '-'}}</td>                                    
                                       <td>{{ !empty($value->optionalSubjects) ? $value->optionalSubjects : '-'}}</td> -->
                                    </tr>
                                 @endforeach
                                 </tbody>
                              </table>

                           </fieldset>
                        </div>
                           <div class="row form-group  mt-3 ">
                              <div class="col-md-6 text-right"> 
                                 <button type="submit" class="btn btn-success mb-1">Save And Next</button>
                              </div>
                           </div>
                        </form>
      </div>
   </div>
</div>

<!-- Edit Qualification modal -->
<div class="modal" id="editExperienceModal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   
</div>
    <!--Edit Qualification Modal  -->
@endsection
@section('js')
<script type="text/javascript">

   
   $(function () 
   {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            // @can('')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        

            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('experience.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            // @endcan()

            $.extend(true, $.fn.dataTable.defaults, {
                // order: [[ 1, 'ASC' ]],
                pageLength: 100,
            });


            $('.datatable-experience:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
   });
 

   function getDays(date1, date2) {

      console.log(date(date1,"dd-mm-YYYY"));
      console.log(date(date2,"dd-mm-YYYY"));
      return false;
         var d1d = date1.getDay();
         var d2d = date2.getDay();
         var d1Y = date1.getFullYear();
        var d2Y = date2.getFullYear();
        var d1M = date1.getMonth();
        var d2M = date2.getMonth();
        return (d2d+d2M+12*d2Y)-(d1d+d1M+12*d1Y);
   }

   function getMonths(date1,date2){
      
      var d1Y = date1.getFullYear();
        var d2Y = date2.getFullYear();
        var d1M = date1.getMonth();
        var d2M = date2.getMonth();

        return (d2M+12*d2Y)-(d1M+12*d1Y);
   }

   function getYears(date1,date2){
      return diffInYr = date2.getFullYear() - date1.getFullYear();
   }

   $('#toDate').on('change',function(){
      var employment = $('#typeEmploymentLookupId').val();
      
      let fromDate = $('#fromDate').val();
      var toDate = $(this).val();
    
      if(employment=='PAST'){
         const date1 = new Date(fromDate);
         const date2 = new Date(toDate);

         var days = getDays(date1, date2);
         var months = getMonths(date1, date2);
         var years = getYears(date1, date2);
        console.log(days+'-'+months+'-'+years);
         
      }else{

      }
   });

   $(document).on('change', '#typeEmploymentLookupId', function() {
      valueFlush(['toDate']); 
      var typeEmploymentLookupId = $(this).val();
      if (typeEmploymentLookupId == "PRESENT") {
         $('.toDate').hide();
      } else {
         $('.toDate').show();
      }
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

   //flgMpscSelection
   $(document).on('change', '#flgMpscSelection', function() {
         // valueFlush(['postNameLookupId']); 
         var flgMpscSelection = $(this).val();
            if (flgMpscSelection == "NO") {
               $('.postNameLookupId').hide();
            } else {
               $('.postNameLookupId').show();
            }
   });

   $(document).on('change', '#editflgMpscSelection', function() {
         // valueFlush(['postNameLookupId']); 
         var flgMpscSelection = $(this).val();
            if (flgMpscSelection == "NO") {
               $('.editpostNameLookupId').hide();
            } else {
               $('.editpostNameLookupId').show();
            }
   });


   //flgGazettedPost
   $(document).on('change', '#flgGazettedPostId', function() {
   //  valueFlush(['typeGroupLookupId']); 
      var flgGazettedPost = $(this).val();
      
      if (flgGazettedPost == "NO") {
         $('.typeGroupLookupId').hide();
      } else {
         $('.typeGroupLookupId').show();
      }
   });

   $(document).on('change', '#editflgGazettedPostId', function() {
   //  valueFlush(['typeGroupLookupId']); 
      var flgGazettedPost = $(this).val();
      
      if (flgGazettedPost == "NO") {
         $('.edittypeGroupLookupId').hide();
      } else {
         $('.edittypeGroupLookupId').show();
      }
   });
   
   function apointmentNaturechange(token,type=null){   
      if(type==null){
         valueFlush(['editappointmentLetterNo','editletterDate']);  
            var apointmentNatureLookupId = token;
            
            if (apointmentNatureLookupId == '269' || apointmentNatureLookupId == "258" || apointmentNatureLookupId == "272" || apointmentNatureLookupId == "271") {
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
      }
      else{
         valueFlush(['appointmentLetterNo','letterDate']);  
      var apointmentNatureLookupId = token;
      
      if (apointmentNatureLookupId == '269' || apointmentNatureLookupId == "258" || apointmentNatureLookupId == "272" || apointmentNatureLookupId == "271") {
         $('.editappointmentContent').show();
      } 
      else if(apointmentNatureLookupId == "269")
      {
         $('.editfullTimeLookup').show();
      }
      else {
         $('.editappointmentContent').hide();
         $('.editfullTimeLookup').hide();
      } 
      }
   }

   function editExperience(element){
            var $this = $(element);
            var action = $this.attr('action');
            $.ajax({
                type:'get',
                url: action,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    $('#editExperienceModal').html(response.html);
                    $('#editExperienceModal').modal('toggle');                 
                },
                error: function(response) {
                }
            })
      }

   $(document).ready(function() 
   {
         $("#experienceForm").validate({
            // Specify validation rules
            rules: {
               employmentType : "required",
               flgMpscSelection : "required",    
               officeName : "required",    
               flgOfficeGovOwned : "required",    
               designation : "required",    
               jobNatureLookupId : "required",    
               flgGazettedPost : "required",        
               apointmentNatureLookupId : "required",                   
               payScale : "required",    
               gradePay : "required",    
               basicPay : "required",    
               monthlyGrossSalary : "required",    
               fromDate : "required",   
               typeGroup:{
                           required: function () { return $('#flgGazettedPostId').val()==='YES';},
                  },                
               postNameLookupId:{
                           required: function () { return $('#flgMpscSelection').val()==='YES';},
                  },
               toDate:{
                        required: function () { return $('#typeEmploymentLookupId').val()==='PAST';},
               },  
               appointmentLetterNo:{
                        required: function () { return $('#apointmentNatureLookupId').val()==='258';},
                        // required: function () { return $('#apointmentNatureLookupId').val()==='269';},
               },
                 letterDate:{
                        required: function () { return $('#apointmentNatureLookupId').val()==='258';},
                        // required: function () { return $('#apointmentNatureLookupId').val()==='269';},
               },
               time:{
                        required: function () { return $('#apointmentNatureLookupId').val()==='269';},
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
                              url: "{{ route('experience.store')}}",
                              data: $(form).serialize(),
                              type: 'POST',
                              success : function(data){
                                 // console.log(data);
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

   $(document).on('click','#editexperiencesubmit',function(e)
   {
      e.preventDefault();

      url = $('#updateexperienceform').attr('action');
      data = $('#updateexperienceform').serialize();
   
               $.ajax({
                              url:url,
                              data: data,
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
   });
      </script>
@include('include.user.UserCustomJs')
@endsection