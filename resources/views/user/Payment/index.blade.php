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
         <form id="SecurityDepositeForm" name="SecurityDepositeForm" method="post" action="{{ route('payment.store') }}" autocomplete="off">
            @csrf
            <input type="hidden" id="user_id" class="form-control"> 
            <fieldset class="form-fieldset">
               <input type="hidden" id="amount_id" name="amount[]" class="form-control">                
               <legend>Postwise Fees</legend>
               <div class="row form-group">
                  <div class="col-md-12 text-right">
                  <table class="table table-bordered table-centered mb-0 tableData">
                         <thead class="table-dark">
                          <tr>
                             <th>Sr No.</th>
                             <th>Job Name</th>
                             <th>Job Description</th>
                             <th>Caste</th>
                             <th>Sub Caste</th>
                             <th>Fees</th>
                             <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($jobfees as $value)
                           <tr data-id="{{ $value->id }}">
                              <td>{{ $value->id}}</td>
                              <td>{{ App\Traits\Convertors::jobName($value->job_id)}}</td>
                              <td>{{!empty($value->description) ? $value->description :'-'}}</td>
                              <td>{{ !empty($value->caste) ? $value->caste :'-'}}</td>
                              <td>{{ !empty($value->sub_caste) ? $value->sub_caste :'-'}}</td>
                              <td  >{{ !empty($value->fees) ? $value->fees :'-' }}</td>                              
                              <td data-fees="jobwisefees_{{$value->id}}">
                                 <input type="checkbox" class="check" name="postwisejob_id[]" onclick="jobwisetotal({{ $value->fees }},$(this).prop('checked'),{{ $value->id }})" value="{{ $value->id }}"></td>
                           </tr>                        
                           @endforeach
                            
                        </tbody>
                     </table>
                  </div>
               </div>
            </fieldset>
            <fieldset class="form-fieldset mt-3">
               <input type="hidden" id="groupamount_id" name="group_amount[]" class="form-control">                
                           <legend>Application Fees </legend>
                        <table class="table table-bordered table-centered mb-0 tableData">
                         <thead class="table-dark">
                          <tr>
                             <th>Sr No.</th>
                             <th>Group Name</th>
                             <th>Job Name</th>
                             <th>Caste</th>
                             <th>Category</th>
                             <th>Job Description</th>
                             <th>Fees</th>
                             <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($jobgroupfees as $value)
                           <tr data-id="{{ $value->id }}">
                              <td >{{ $value->id}}</td>
                              <td >{{!empty($value->group_name) ? $value->group_name :'-'}}</td>
                              <td >{{ !empty($value->job_id) ? App\Traits\Convertors::multipleJobName($value->job_id) : '-' }}</td>                              
                              <td >{{ !empty($value->caste) ? $value->caste :'-'}}</td>
                              <td >{{ !empty($value->sub_caste) ? $value->sub_caste :'-'}}</td>
                              <td >{{ !empty($value->description) ? $value->description :'-'}}</td>
                              <td >{{ !empty($value->fees) ? $value->fees :'-' }}</td>                              
                              <td  data-fees="jobwisefees_{{$value->id}}"><input name="grouppostjob_id[]" type="checkbox" class="check" onclick="jobgroupwisetotal({{ $value->fees }},$(this).prop('checked'),{{ $value->id }})" value="{{ $value->id}}"></td>
                           </tr>                        
                           @endforeach                          
                       
                         </tbody>
                     </table>

                     <table class="table table-bordered table-centered mb-0 tableData">
                        <thead class="table-dark">
                        </thead>
                        <tbody>
                           <tr>
                              <td >Total
                              </td>
                              <td  id="totalcheckpay">
                              </td>
                           </tr>
                           <tr>
                              <td rowspan="10"><button type="submit"  method="POST"
                              class="form-control btn btn-success" id="Payable">Pay</button>
                              </td>
                           </tr>
                        </tbody>
                     </table>
            </fieldset> 
         </form>
      </div>
   </div>
@endsection
@section('js')

<script>

   var payment_store = '{{ route('payment.store')}}';
   
   function jobwisetotal(value,check,job_id)
   {
      let checked =   check; 
  
         const check_value = parseInt(value);
         const num = 0;
         const amount = parseInt($('#amount_id').val());
         const groupamount = parseInt($('#groupamount_id').val());
         const total = parseInt($('#totalcheckpay').html());
       
         if(checked==true){
       

               if(amount>0){
                     const increvalue = amount + check_value;
                     $('#amount_id').html('');               
                     $('#amount_id').val(increvalue);
                  
                     if(groupamount>0){
                        const totalvalue = increvalue + groupamount;
                        $('#totalcheckpay').html(totalvalue);
                     }else{
                        const totalvalue = increvalue;
                        $('#totalcheckpay').html(totalvalue);
                     }
               }else{
                     const sum = num + check_value;
                 
                     $('#amount_id').val(sum);             

                     if(groupamount>0){
                        const totalvalue = sum + groupamount;
                        $('#totalcheckpay').html(totalvalue);
                     }else{
                        const totalvalue = sum;
                        $('#totalcheckpay').html(totalvalue);
                     }
               }
         }else if(checked==false){
            $('#job_id').remove(job_ids);
               if(amount>0){
                     const decrevalue = amount - check_value;            
                     $('#amount_id').val(decrevalue);
                     
                     if(total>0){
                        const totalvalue = total - check_value;
                        $('#totalcheckpay').html(totalvalue);
                     }
                     else{

                     }                    
               }
         }   
   }

   function jobgroupwisetotal(value,check,job_id)
   {
         let checked = check; 

         const num = 0;
         const check_value = parseInt(value);
         const amount = parseInt($('#amount_id').val());
         const groupamount = parseInt($('#groupamount_id').val());
         const total = parseInt($('#totalcheckpay').html());

         if(checked==true){
        
      

               if(groupamount>0){
                     const increvalue = groupamount + check_value;
                              
                     $('#groupamount_id').val(increvalue);
                   
                     if(amount>0){
                        const totalvalue = increvalue + amount;
                        $('#totalcheckpay').html(totalvalue);
                     }else{
                        const totalvalue = increvalue;
                        $('#totalcheckpay').html(totalvalue);
                     }
               }else{
                     const sum = num + check_value;
                
                     $('#groupamount_id').val(sum);
                

                     if(amount>0){
                        const totalvalue = sum + amount;
                        $('#totalcheckpay').html(totalvalue);
                     }else{
                        const totalvalue = sum;
                        $('#totalcheckpay').html(totalvalue);
                     }
               }
         }else if(checked==false){
               if(groupamount>0){
                     const decrevalue = groupamount - check_value;
                  
                     $('#groupamount_id').val(decrevalue);
                     
                     if(total>0){
                        const totalvalue = total - check_value;
                        $('#totalcheckpay').html(totalvalue);
                     }
                     else{

                     }                    
               }
         }  
   }
   
</script>
@endsection