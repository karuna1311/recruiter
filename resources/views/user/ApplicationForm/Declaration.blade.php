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
         <form id="submitDeclarationForm" action="POST" autocomplete="off">
            @csrf
            <fieldset class="form-fieldset">
               <legend>Declaration  </legend>
               <div class="row form-group br-bt-1 ">
                  <div class=" col-md-12">
                     <div class="custom-control custom-checkbox mb-2 d-flex" >
                        <input type="checkbox" name="declare1" class="custom-control-input declarecheckbox" id="declare1">
                        <label class="custom-control-label" for="declare1"> {{ trans('cruds.Declaration.fields.declare1_eng') }}<br> <span class="text-muted">{{ trans('cruds.Declaration.fields.declare1_dev') }}</span>
                        </label>
                     </div>
                     <div class="custom-control custom-checkbox mb-2 d-flex">
                        <input type="checkbox" name="declare2" class="custom-control-input declarecheckbox" id="declare2">
                        <label class="custom-control-label" for="declare2">{{ trans('cruds.Declaration.fields.declare2_eng') }} <br> <span class="text-muted">{{ trans('cruds.Declaration.fields.declare2_dev') }}</span></label>
                     </div>
                     <div class="custom-control custom-checkbox mb-2 d-flex">
                        <input type="checkbox" name="declare3" class="custom-control-input declarecheckbox" id="declare3">
                        <label class="custom-control-label" for="declare3"> {{ trans('cruds.Declaration.fields.declare3_eng') }} <br> <span class="text-muted">{{ trans('cruds.Declaration.fields.declare3_dev') }}</span></label>
                     </div>
                     <div class="custom-control custom-checkbox mb-2 d-flex">
                        <input type="checkbox" name="declare4" class="custom-control-input declarecheckbox" id="declare4">
                        <label class="custom-control-label" for="declare4">{{ trans('cruds.Declaration.fields.declare4_eng') }} <br><span class="text-muted">{{ trans('cruds.Declaration.fields.declare4_dev') }}</span></label>
                     </div>
                     <div class="custom-control custom-checkbox mb-2 d-flex">
                        <input type="checkbox" name="declare5" class="custom-control-input declarecheckbox" id="declare5">
                        <label class="custom-control-label" for="declare5">{{ trans('cruds.Declaration.fields.declare5_eng') }} <br><span class="text-muted">{{ trans('cruds.Declaration.fields.declare5_dev') }}</span></label>
                     </div>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 text-right">
                     <button type="submit" class="btn btn-success mb-3">Save And Next</button>
                  </div>
               </div>
            </fieldset>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="confirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Please Confirm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
         </div>
         <!-- end modal header -->
         <div class="modal-body text-center">
            <p class="mb-0">{{ trans('confirmationModal.confirmationModal.content_Eng') }}</p>
            <p>{{ trans('confirmationModal.confirmationModal.content_Dev') }}</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" id="confirmAndLock">Yes</button>
         </div>
         <!-- end modal footer -->
      </div>
      <!-- end modal content-->
   </div>
   <!-- end modal dialog-->
</div>
@if(isset($declarationData) && $declarationData->declaration_status=='1')
<script type="text/javascript">
   $('#declare1').attr("checked","checked");
   $('#declare2').attr("checked","checked");
   $('#declare3').attr("checked","checked");
   $('#declare4').attr("checked","checked");
   $('#declare5').attr("checked","checked");
</script>
@endif
@endsection
@section('js')
<script>
   $(document).ready(function() {
      $('#submitDeclarationForm').validate({
         rules: {
            'declare1' : 'required',
            'declare2' : 'required',
            'declare3' : 'required',
            'declare4' : 'required',
            'declare5' : 'required',
         },
         messages: {
            'declare1' : 'Declaration is required',
            'declare2' : 'Declaration is required',
            'declare3' : 'Declaration is required',
            'declare4' : 'Declaration is required',
            'declare5' : 'Declaration is required',
         },
         
         submitHandler: function(form) {
            $('#confirmation').modal('toggle');
         }
      });
      $('#confirmAndLock').on('click', function(event) {
         event.preventDefault();
               $.ajax({
               url : "{{ route('declaration.update', [$declarationData->id]) }}",
               type : 'put',
               data:$('#submitDeclarationForm').serialize(),
               beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden');
   
                  },
               success : function(data){
                 if (data.ValidatorErrors) {
                      $.each(data.ValidatorErrors, function(index, jsonObject) {
                        $.each(jsonObject, function(key, val) {
                            toastr.error(val);
                        });
                        return false;
                      });
                    }
                    if (data.status) {
                      if(data.status==='error') toastr.error(data.data);
                      else if(data.status==='success'){
                          toastr.success(data.data);
                          window.location.replace("{{route('session.index')}}");
                        }
                    }
               },
               complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden');
                  },
               error:function (response) {
                   let data = response.responseJSON;
                   toastr.error(data);
               }
            });
      });
   });
</script>
@include('include.user.UserCustomJs')
@endsection