@extends('layouts.UserDashboard')
@section('content')
@if(session('msg_error'))
<div class="alert alert-danger" align="center">
   <p>{{ session('msg_error') }}</p>
</div>      
@endif
<div class="row">
   <div class="col-6">
      <div class="page-title-box">
         <h4 class="page-title">Application Form</h4>
      </div>
   </div>
   <div class="col-6 mt-3">
      <form action="{{ route('payment.unlockProfile') }}" method="POST" >
         <input type="hidden" name="_method" value="POST">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="submit" class="btn btn-xs btn-success pull-right" value="Unlock Profile">
      </form>
   </div>
   <div class="col-12">
      <div class="tab-content">
     
         <form id="paymentForm" name="paymentForm" method="post" action="{{ route('payment.store') }}" autocomplete="off">
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
                            @if(empty($jobfees))                        
                           <tr>
                              <td colspan="7">No Fees updated by Admin</td>
                           </tr>
                           @else 
                           <?php $i =1; ?>
                              @foreach($jobfees as $value)
                                 <tr data-id="{{ $value->id }}">
                                    <input type="hidden" disabled name="job_id[]" id="job_id{{$value->id}}">
                                    <td>{{ $i }}</td>
                                    <td>{{ App\Traits\Convertors::postName($value->job_id)}}</td>
                                    <td>{{!empty($value->description) ? $value->description :'-'}}</td>
                                    <td>{{ !empty($value->caste) ? $value->caste :'-'}}</td>
                                    <td>{{ !empty($value->sub_caste) ? $value->sub_caste :'-'}}</td>
                                    <td  >{{ !empty($value->fees) ? $value->fees :'-' }}</td>
                                    @if($value->payment_status=='SUCCESS')                              
                                       <td>
                                          <a class="btn btn-success disabled" >Paid</a>
                                       </td>
                                    @else
                                    <td data-fees="jobwisefees_{{$value->id}}">
                                       <input type="checkbox" class="check" name="postwisejob_id[]" onclick="jobwisetotal({{ $value->fees }},$(this).prop('checked'),{{ $value->id }},{{ $value->job_id}})" value="{{ $value->id }}">                                       
                                    </td>
                                    @endif
                                     <?php $i++; ?>
                                 </tr>                        
                              @endforeach
                             
                            @endif  
                        </tbody>
                     </table>
                  </div>
               </div>
            </fieldset>
            {{-- <fieldset class="form-fieldset mt-3">
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
                           @if(in_array(null,$jobgroupfees))                        
                           <tr>
                              <td colspan="8">No Fees updated by Admin</td>
                           </tr>
                           @else
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
                           @endif 
                           
                       
                         </tbody>
                     </table>                
            </fieldset>  --}}
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
         </form>
      </div>
     
   </div>
@endsection
@section('js')

<script>

   var payment_store = '{{ route('payment.store')}}';
   
   function jobwisetotal(value,check,post_id,job_id)
   {
      let checked = check; 
  
         const check_value = parseInt(value);
         
         const num = 0;
         const amount = parseInt($('#amount_id').val());
         const groupamount = parseInt($('#groupamount_id').val());
         const total = parseInt($('#totalcheckpay').html());
       
         if(checked==true){
            
            $('#job_id'+post_id).prop('disabled',false);
            $('#job_id'+post_id).val(job_id);

               if(amount>0){
                     const increvalue = amount + check_value;
                     $('#amount_id').html('');   
                     console.log(increvalue);            
                     $('#amount_id').val(increvalue);
                  
                     if(groupamount>0){
                        const totalvalue = increvalue + groupamount;
                        console.log(totalvalue);
                        $('#totalcheckpay').html(totalvalue);
                     }else{
                        const totalvalue = increvalue;
                        console.log(totalvalue);
                        $('#totalcheckpay').html(totalvalue);
                     }
               }else{
                     const sum = num + check_value;
                 
                     $('#amount_id').val(sum);             

                     if(groupamount>0){
                        const totalvalue = sum + groupamount;
                        console.log(totalvalue);
                        $('#totalcheckpay').html(totalvalue);
                     }else{
                        const totalvalue = sum;
                        console.log(totalvalue);
                        $('#totalcheckpay').html(totalvalue);
                     }
               }
         }else if(checked==false){
            $('#job_id'+post_id).prop('disabled', true); 
            // console.log(job_id);
            // $('#job_id').remove(job_id);
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

   // function jobgroupwisetotal(value,check,job_id)
   // {
   //       let checked = check; 

   //       const num = 0;
   //       const check_value = parseInt(value);
   //       const amount = parseInt($('#amount_id').val());
   //       const groupamount = parseInt($('#groupamount_id').val());
   //       const total = parseInt($('#totalcheckpay').html());

   //       if(checked==true){
        
      

   //             if(groupamount>0){
   //                   const increvalue = groupamount + check_value;
                              
   //                   $('#groupamount_id').val(increvalue);
                   
   //                   if(amount>0){
   //                      const totalvalue = increvalue + amount;
   //                      $('#totalcheckpay').html(totalvalue);
   //                   }else{
   //                      const totalvalue = increvalue;
   //                      $('#totalcheckpay').html(totalvalue);
   //                   }
   //             }else{
   //                   const sum = num + check_value;
                
   //                   $('#groupamount_id').val(sum);
                

   //                   if(amount>0){
   //                      const totalvalue = sum + amount;
   //                      $('#totalcheckpay').html(totalvalue);
   //                   }else{
   //                      const totalvalue = sum;
   //                      $('#totalcheckpay').html(totalvalue);
   //                   }
   //             }
   //       }else if(checked==false){
   //             if(groupamount>0){
   //                   const decrevalue = groupamount - check_value;
                  
   //                   $('#groupamount_id').val(decrevalue);
                     
   //                   if(total>0){
   //                      const totalvalue = total - check_value;
   //                      $('#totalcheckpay').html(totalvalue);
   //                   }
   //                   else{

   //                   }                    
   //             }
   //       }  
   // }
   
</script>
@endsection