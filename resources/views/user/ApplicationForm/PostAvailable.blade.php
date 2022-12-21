@extends('layouts.UserDashboard')
@section('content')
               <div class="row">
                  <div class="col-12">
                     <div class="page-title-box">
                        <h4 class="page-title">Application Form</h4>
                     </div>
                  </div>
                  <div class="col-12">
                     @if(session('msg_error'))
                     <div class="alert alert-danger" align="center">
                        <p>{{ session('msg_error') }}</p>
                     </div>      
                  @endif

                     <div class="tab-content">
                     
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
                                         <th>Remark</th>
                                         <th>Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>                                    
                                                                     
                                       <?php  $j = 1; 
                                       foreach($job_array as $value){ ?>                                       
                                        <tr id="row_{{$value['id']}}" data-id="{{ $value['id'] }}">
                                                       <td>{{ $j }}</td>
                                                       <td>{{ $value['name']}}</td>                                                                                        
                                                       <td>{{ $value['year']}}</td>                                                                                        
                                                       <td id="remark_{{$value['id']}}"></td>  
                                                       @if(in_array($value['id'],$applied_array))
                                                       <td>
                                                          <a class="btn btn-success disabled" >Applied</a>
                                                       </td>                                                      
                                                       @else
                                                       <td>
                                                          <a href="{{ route('postavailable.checkJob',[base64_encode($value['id'])]) }}" method="POST" class="btn btn-primary checkjob" value="{{ $value['id'] }}" id="job_{{ $value['id'] }}">Check</a>
                                                          <a href="{{ route('postavailable.applyJob',[base64_encode($value['id'])]) }}" method="POST" class="btn btn-info applyJob disabled" value="{{ $value['id'] }}" id="apply_{{ $value['id'] }}" >Apply</a>
                                                       </td>
                                                       @endif                                                  
                                                       <?php $j++; ?>                          
                                        </tr>                                       
                                        <?php }    ?>                                                                          
                                   </tbody>
                                </table> 
                             </div>
                           </fieldset>
                           <br>
                         
                  
                        </form>
                        <div class="row form-group  mt-3 ">
                           <div class="col-md-6 text-right">                               
                              <form action="{{ route('postavailable.checkPostAvailable') }}" method="POST">
                                 <input type="hidden" name="_method" value="POST">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="submit" class="btn btn-xs btn-success" value="Save and Next">
                              </form>
                           </div>                                  
                        </div>
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
               
                $.ajax({
                    type: "post",
                    url: action,                   
                    success: function(response){     
                     console.log(response); 
                     $('#remark_'+row_value).html('');                     
                        count = 1;                       
                    
                        if(response.status== 'multipleError'){
                          
                           $.each( response.Reservation, function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                          
                           $.each( response.Qual_exp, function( index, value ){                            
                              $('#remark_'+row_value).append(count+'.'+value+'<br>');
                              count++;
                           });
                          
                        }else if(response.status== 'success'){
                           $('#remark_'+row_value).append('Candidate is Eligible');
                        }else if(response.status== 'error'){
                            $('#remark_'+row_value).append(response.Qual_exp);
                            $('#remark_'+row_value).append(response.Reservation);
                        }
                        

                        if(response.status == 'multipleError'){
                           $('#apply_'+row_value).addClass('disabled');
                        }else{
                           $('#apply_'+row_value).removeClass('disabled');
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
                        window.location.reload();
                      }
                    }
                });               
               }
              
            });
            
      </script>
      @endsection()
@endsection