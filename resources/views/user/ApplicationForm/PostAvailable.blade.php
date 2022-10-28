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
                     <?php $sr = 0 ?>
                        <form>
                           <fieldset class="form-fieldset">
                              <legend>Available Post </legend>
                             <div>
                                <table class="table  table-bordered table-responsive w-100">
                                   <thead class="thead-light">
                                      <tr>
                                         <th>Sr. No.</th>
                                         <th>Post Name</th>
                                         <th>Year</th>
                                         <th>Post Description</th>
                                         <th>Remark</th>
                                         <th>Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                    
                                      <?php foreach($jobs as $value){ ?>
                                      
                                             <tr id="row_{{$value->id}}" data-id="{{ $value->id }}">
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name}} <br><span class="text-muted">{{ $value->name_dvng}}</span> </td>
                                                <td>{{ $value->year}}</td>
                                                <td>{{ $value->description}} </td>                                      
                                                <td id="remark_{{$value->id}}"></td>                                      
                                                <td>
                                                <a href="{{ route('PostAvailable.checkJob',[base64_encode($value->id)]) }}" method="POST" class="btn btn-primary checkjob" value="{{ $value->id }}" id="job_{{ $value->id }}">Check</a>
                                                <a href="{{ route('PostAvailable.applyJob',[base64_encode($value->id)]) }}" method="POST" class="btn btn-info applyJob disabled" value="{{ $value->id }}" id="apply_{{ $value->id }}" >Apply</a>
                                                
                                             </td>
                                             </tr>
                                  
                                         <?php }  $sr++; ?>                          
                                   </tbody>
                                </table> 
                             </div>
                           </fieldset>
                           <br>
                         
                           <div class="row form-group  mt-3 ">
                              <div class="col-md-6 text-right"> 
                                 <button type="button" class="btn btn-success mb-1">Save And Next</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
      @include('include.user.UserCustomJs')
      @section('js')
      <script>
            $('.checkjob').click(function (e){
               e.preventDefault();

               $.ajaxSetup({
                        headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
               });
               
               action = $(this).attr('href');
               row_value = $(this).attr('value');
               // console.log('row_value:'+row_value);
                $.ajax({
                    type: "post",
                    url: action,                   
                    success: function(response){     
                     console.log(response);                      
                        count = 1;
                    
                        if(response.per_res_error!=undefined){
                           $.each( response.per_res_error[0], function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        } 
                        
                        if(response.exp_error!=undefined){
                           $.each( response.exp_error[0], function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }

                        if(response.qual_error!=undefined){
                           $.each( response.qual_error[0], function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }
                        if(response.res_error!=undefined){
                           $.each( response.res_error[0], function( index, value ){                              
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }

                        if(response.per_res_success!=undefined && response.success==1){
                           $.each( response.per_res_success[0], function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }

                        if(response.res_success!=undefined && response.success==1 ){
                           $.each( response.res_success[0], function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }

                        if(response.qual_success!=undefined && response.success==1  ){
                           $.each( response.qual_success[0], function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }
                        if(response.exp_success!=undefined && response.success==1 ){
                           $.each( response.exp_success[0], function( index, value ){                              
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                        }

                        if(response.error == 0 && response.success == 1){
                           $('#apply_'+row_value).removeClass('disabled');
                        }else{
                           $('#apply_'+row_value).addClass('disabled');
                        }
                    }
                });
            });

            $('.applyJob').click(function (e){
               e.preventDefault();
               $.ajaxSetup({
                        headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
               });
               
               id = $(this).attr('id');
              
               if($('#'+id).hasClass('disabled')){                  
                  toastr.warning('Your are not eligible for this Post');
               }else{
                  action = $(this).attr('href');  
                  
                  $.ajax({
                    type: "post",
                    url: action,                   
                    success: function(response){   
                      
                      if(response.status=='error'){
                        toastr.warning(response.msg)
                      }else if(response.status=='success'){
                        toastr.success(response.msg)
                      }
                    }
                });               
               }
              
            });
      </script>
      @endsection()
@endsection