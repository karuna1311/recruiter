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
         @if(session('msg_error'))
            <div class="alert alert-danger" align="center">
               <p>{{ session('msg_error') }}</p>
            </div>      
         @endif
         <form id="experienceForm">
            @csrf
                           <fieldset class="form-fieldset">
                              <legend>Experience Information <span class="text-muted">अनुभव माहिती</span></legend>
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
                                    <label >Select Post Name /Designation <span class="asrtick">*</span></label>
                                    <select class="form-control" name="postNameLookupId" id="postNameLookupId">                                       
                                       @foreach($post_name as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                      
                                    </select>
                                 </div>

                                 <div class="col-md-3 mt-3 hide designation">
                                    <label >Designation <span class="asrtick">*</span></label>
                                    <input type="text" class="form-control" name="designation" maxlength="200" value="">
                                 </div>


                                 <div class="col-md-3 mt-3">
                                    <label >Institution / Department / Organisation  <span class="asrtick">*</span></label>
                                    <input type="text" class="form-control" name="officeName" maxlength="500" value="">
                                 </div>
                              
                                 <div class="col-md-3 mt-3" >
                                    <label >Nature Of Job <span class="asrtick">*</span></label>
                                    <select class="form-control select2" name="jobNatureLookupId" id="jobNatureLookupId">
                                    @foreach($job_nature as $key=>$value)
                                          <option value="{{ $key }}">{{ $value }}</option>
                                       @endforeach                                     
                                    </select>
                                 </div>
                              
                              </div>
                              <div class="row">
                              
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
                                    <label style="margin-left: 15px;">Appointment Letter No <span class="redColor">*</span></label>
                                    <input type="text" class="form-control" name="appointmentLetterNo" id="appointmentLetterNo"  value="">
                                 </div>

                                 <div class="col-md-3 mb-3 appointmentContent">
                                    <label style="float: left;">Letter Date <span class="redColor">*</span></label>
                                    <input type="date" class="form-control" name="letterDate" id="letterDate">
                                 </div>


                              </div>

                              <div class="row">
                                 <div class="col-md-3 mb-3">
                                    <label>Pay Band / Pay Scale / Professional Charge</label>
                                    <input type="text" class="form-control" maxlength="20" name="payScale" id="payScale" >
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label>Grade Pay</label>
                                    <input type="text" class="form-control" maxlength="6" name="gradePay" id="gradePay" >
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label>Basic Pay / Minimum Professional Charge</label>
                                    <input type="text" class="form-control" maxlength="6" name="basicPay" id="basicPay" >
                                 </div>
                                 <div class="col-md-3 mb-3">
                                    <label>Monthly Gross Salary / Income</label>
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
                                    <input type="numeric" class="form-control expYears" readonly  name="expYears" id="expYears">
                                 </div>
                                 <div class="col-md-1 mb-3">
                                    <label>Months</label>
                                    <input type="numeric" class="form-control expMonths" readonly name="expMonths" id="expMonths">
                                 </div>
                                 <div class="col-md-1 mb-3">
                                    <label>Days</label>
                                    <input type="numeric" class="form-control expDays" readonly name="expDays" id="expDays">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12 text-right"> 
                                    <button type="submit" class="btn btn-success mb-1">Add new</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                           <br>
                           <fieldset class="form-fieldset">
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover datatable datatable-experience">                              
                                 <thead class="thead-light">
                                    <tr>
                                       <th></th>
                                       <th>Sr No</th>
                                       <th>Institution / Department / Organisation</th>
                                       <th>Designation </th>
                                       <th>Nature Of Appointment</th>
                                       <th>Nature Of Job</th>
                                       <th>Full Time / Other</th>
                                       <th>Pay Band / Pay Scale / Professional Charge</th>
                                       <th>Grade Pay</th>
                                       <th>Monthly Gross Salary / Income</th>
                                       <th>From Date</th>
                                       <th>To Date</th>
                                       
                                       
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody style="font-size: 12px;">
                                    <?php $i=1; ?>
                                 @foreach($user_experience as $value)
                                    <tr>
                                       <td></td>
                                       <td>{{ $i }}</td>
                                       <td>{{ !empty($value->officeName) ? $value->officeName : '-'}}</td>
                                       <td>{{ !empty($value->post_name) ? $value->post_name : '-'}}</td>
                                       <td>{{ !empty($value->appointment) ? $value->appointment : '-'}}</td>
                                       <td>{{ !empty($value->job_nature) ? $value->job_nature : '-'}}</td>                                    
                                       <td>{{ !empty($value->time) ? $value->time : '-'}}</td>                                    
                                       <td>{{ !empty($value->payScale) ? $value->payScale : '-'}}</td>                                    
                                       <td>{{ !empty($value->gradePay) ? $value->gradePay : '-'}}</td>                                                                                                           
                                       <td>{{ !empty($value->monthlyGrossSalary) ? $value->monthlyGrossSalary : '-'}}</td>                                    
                                       <td>{{ !empty($value->fromDate) ? $value->fromDate : '-'}}</td>                                    
                                       <td>{{ !empty($value->toDate) ? $value->toDate : '-'}}</td>                                    
                                       
                                       <td>
                                                <a type="button" class="btn btn-xs btn-info"
                                                data-bs-toggle="modal"  onclick="editExperience(this)"
                                                   action="{{ route('experience.edit', base64_encode($value->id)) }}"
                                                   >
                                                    {{ trans('global.edit') }}
                                                </a> 
                                                
                                                <form action="{{ route('experience.destroy', base64_encode($value->id)) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                   <input type="hidden" name="_method" value="DELETE">
                                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                   <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                                                      
                                       </td>

                                                <!-- <td>{{ !empty($value->compulsorySubjects) ? $value->compulsorySubjects : '-'}}</td>                                    
                                       <td>{{ !empty($value->optionalSubjects) ? $value->optionalSubjects : '-'}}</td> -->
                                    </tr>
                                    <?php $i++; ?>
                                 @endforeach
                                 </tbody>
                              </table>

                           </fieldset>
                        </div>
                           <div class="row form-group  mt-3">

                              <div class="col-md-12 text-center"> 
                                 {{-- <a  href="{{ route('postavailable.index') }}" class="btn btn-success mb-1">Save and Next</a> --}}

                                 <form action="{{ route('experience.checkExperience') }}" method="POST">
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-success" value="Save and Next">
                                 </form>
                              </div>
                           </div>
                        
      </div>
   </div>
</div>

<!-- Edit Experience modal -->
<div class="modal" id="editExperienceModal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   
</div>
    <!--Edit Experience Modal  -->
@endsection
@section('js')
<script type="text/javascript">

   
   $(function () 
   {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
           
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
 
   $('#postNameLookupId').on('change',function(){      
      value = $(this).val();
      if(value==433){
         $('.designation').show();
      }else{
         $('.designation').hide();
      }
   });

 


   $('#fromDate,#toDate').on('change',function()
   {

      var employment = $('#typeEmploymentLookupId').val();      
      let fromDate      = $('#fromDate').val();
            if(employment=='PRESENT')
            {
             let  today  = moment().format('YYYY-MM-DD');
               // let  today	= new Date();

               // let  dd 		      = String(today.getDate()).padStart(2, '0');
               // let  mm 		      = String(today.getMonth() + 1).padStart(2, '0'); //janvier = 0
               // let  yyyy 		   = today.getFullYear();
               // let toDate        = yyyy+'-'+mm+'-'+dd;
               var secondDate = moment(today,'YYYY-MM-DD');           
               $('#toDate').val(today);

            }else{
               var toDate = $('#toDate').val();
               var secondDate = moment(toDate, 'YYYY-MM-DD');           
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
	
      $('#experienceForm #expYears').val(years);
      $('#experienceForm #expMonths').val(months);
      $('#experienceForm #expDays').val(days);
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



   function apointmentNaturechange(token,type=null){   
      if(type==null){
         valueFlush(['appointmentLetterNo','letterDate']);  
            var apointmentNatureLookupId = token;
            
            if ( apointmentNatureLookupId == "258" || apointmentNatureLookupId == "272" || apointmentNatureLookupId == "271") {
               $('.appointmentContent').show();
            } 
            else if(apointmentNatureLookupId == "269")
            {
               $('.fullTimeLookup').show();
               $('.appointmentContent').show();
            }
            else {
               $('.appointmentContent').hide();
               $('.fullTimeLookup').hide();
            }   
      }
      else{
         valueFlush(['editappointmentLetterNo','editletterDate']);  
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
               
               officeName : "required",    
               flgOfficeGovOwned : "required",                   
               postNameLookupId : "required",
                  designation:{
                        required: function () { return $('#postNameLookupId').val()==='433';},
               },
               jobNatureLookupId : "required",    
               apointmentNatureLookupId : "required",                       
               fromDate : "required",                     
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
                                    // window.location.replace("{{route('postavailable.index')}}");
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