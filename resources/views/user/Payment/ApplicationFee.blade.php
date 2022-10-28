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
         <form id="SecurityDepositeForm" method="POST" autocomplete="off">
            @csrf
            <fieldset class="form-fieldset">
               <legend>Postwise Fees  </legend>
               <div class="row form-group">
                  <div class="col-md-12 text-right">
                  <table class="table table-bordered table-centered mb-0 tableData">
                         <thead class="table-dark">
                          <tr>
                             <th>Sr No.</th>
                             <th>Job Name</th>
                             <th>Job Description</th>
                             <th>Fess</th>
                             <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($jobfees as $value)
                           <tr data-id="{{ $value->id }}">
                              <td>{{ $value->id}}</td>
                              <td>{{ $value->job_id}}</td>
                              <td>{{ $value->description}}</td>
                              <td  >{{ $value->fees}}</td>                              
                              <td data-fees="jobwisefees_{{$value->id}}"><input type="checkbox" class="check" onclick="jobwisetotal($(this).val(),$(this).prop('checked'))" value="{{ $value->fees}}"></td>
                           </tr>                        
                           @endforeach
                             <tr>
                              <td colspan="4" style="text-align: right;"><b>Total:</b></td>
                              <td id="totalcheckpay"><b></b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </fieldset>
            <fieldset class="form-fieldset mt-3">
                           <legend>Application Fees </legend>
                        <table class="table table-bordered table-centered mb-0 tableData">
                         <thead class="table-dark">
                          <tr>
                             <th>Sr No.</th>
                             <th>Group Name</th>
                             <th>Job Name</th>
                             <th>Category</th>
                             <th>Job Description</th>
                             <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td rowspan="2">1.</td>
                              <td rowspan="2">Group Name 1</td>
                              <td>Job Name 1</td>
                              <td rowspan="2">Category</td>
                              <td rowspan="2">Description</td>
                              <td rowspan="2"><input type="checkbox" name="" id=""></td>
                           </tr>
                           <tr>
                            
                              <td >Job Name 2</td>
                           </tr>
                           <tr>
                              <td rowspan="2">2.</td>
                              <td rowspan="2">Group Name 2</td>
                              <td>Job Name 3</td>
                              <td rowspan="2">Category</td>
                              <td rowspan="2">Description</td>
                              <td rowspan="2"><input type="checkbox" name="" id=""></td>
                           </tr>
                           <tr>
                            
                              <td >Job Name 4</td>
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
   
   function jobwisetotal(value,check)
   {
      let checked =   check; 

         const check_value = parseInt(value);
         const num = 0;

         if(checked==true){
         
         const totalcheckpay = parseInt($('#totalcheckpay').text());

         if(totalcheckpay>0){
         const increvalue = totalcheckpay + check_value;
            $('#totalcheckpay').html('');
            $('#totalcheckpay').append(increvalue);
         }else{
            const sum = num + check_value;
            $('#totalcheckpay').html('');
            $('#totalcheckpay').append(sum);
         }
         }else if(checked==false){
            const totalcheckpay = parseInt($('#totalcheckpay').text());

               if(totalcheckpay>0){
                     const decrevalue = totalcheckpay - check_value;
                     $('#totalcheckpay').html('');
                     $('#totalcheckpay').append(decrevalue);
               }
               // else{
               //    // const sum = num + check_value;
               //    // $('#totalcheckpay').html('');
               //    // $('#totalcheckpay').append(sum);
               // }
         }   
   }
</script>
@endsection