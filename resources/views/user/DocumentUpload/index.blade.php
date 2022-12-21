@extends('layouts.UserDashboard')
@section('content')
 <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title">Document Upload</h4>
        </div>
     </div>
  
     <div class="col-12">
        <div class="card card-widget card-events">
           <div class="card-body">
            <form id="documentForm" method="post" enctype="multipart/form-data" autocomplete="off">
            @if(count($documentData))
              <table class="table table-bordered table-centered mb-0 tableData">
                <thead class="table-dark">
                 <tr>
                    <th >Sr No.</th>
                    <th>Document Name</th>
                    <th class="text-center">Document Type </th>
                    <th>Select Document </th>
                    <th>View</th>
                 </tr>
               </thead>
               <?php $i=1; ?>
                 @foreach($documentData as $key=>$data)
                 @php $documentType='';@endphp
                 <tr>
                    <td>{{$i}}</td>
                    <td style="text-align: left;">{{$data->document_name}}</td>
                    <td>
                      @if(!empty($data->allowed_documents))
                      @php $documentType='1';$arryOfType=explode(',',$data->allowed_documents);@endphp
                      <select class="form-control" name="document_type_{{$data->id}}" id="document_type_{{$data->id}}">
                         <option value="">[SELECT]</option>
                         @foreach($arryOfType as $value)
                         <option value="{{$value}}" {{ (isset($data->documentType) && $data->documentType===$value) ? 'selected' : '' }}>{{$value}}</option>
                         @endforeach
                      </select>
                      @endif
                    </td>
                    <td>
                      <input type="file" class="form-control" name="documentFile_{{$data->id}}" data-id="{{$data->id}}" id="documentFile_{{$data->id}}" onchange="imageSelection('{{$documentType}}','document_type_{{$data->id}}','documentFile_{{$data->id}}',['application/pdf'],['200','KB'])" accept="application/pdf">
                    </td> 
                    <td id="documentDiv_{{$data->id}}" style="width: 10%;">@if(!empty($data->documentUploaded))<a id="uploadedFile_{{$data->id}}" href="data:application/pdf;base64,{{$data->documentUploaded}}" download="{{$data->document_code}}.pdf" class="btn fs-18"><i class="uil-eye"></i></a>@endif</td>
                 </tr>
                 <?php $i++;?>
                 @endforeach
              </table>
              @else
              <p>Documents not available</p>
              @endif
              </form>
           </div>
           <div class="row form-group  mt-3 ">
                           
            <div class="col-md-12 pull-right">       
               
               <form id="processCompleted" action="{{ route('appliedJobPayment.index') }}">
                  <input type="hidden" name="_method" value="get">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn btn-xs btn-success" value="Process Completed">
               </form>
                
            </div>
         </div>
           <div class="card-footer bg-transparent">
           </div>
        </div>
     </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
function formatBytes(a,b=2,k=1024)
{
    with(Math)
    {let d=floor(log(a)/log(k));
        var size= 0==a?"0 Bytes":parseFloat((a/pow(k,d)).toFixed(max(0,b)));
        var sizetype=["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"][d];
        return [size,sizetype];
    }
}
  function imageSelection(documentType,documentTypeId,id,fileTypeArray,maxSize,minSize=null){
      var file = document.getElementById(id).files;
      var match= fileTypeArray;
      var fileType =file[0].type;
      var fileSize=formatBytes(file[0].size);
      if(!match.includes(fileType))
      {
         $("#"+id).val('');
         var allowedFormats='';
         $.each(match, function(key, val) {
            allowedFormats +=val+',';
        });
         toastr.error('Allowed Formats: '+allowedFormats);
         return false;
      }
      else if(fileSize[1]!=maxSize[1] || fileSize[0]>maxSize[0])
      {
         $("#"+id).val('');
         toastr.error('File Should Not be greater than '+maxSize[0]+' '+maxSize[1]);
         return false;
      }
      var documentId=$('#'+id).attr('data-id');
      var url = '{{ route("document.upload", ":documentId") }}';
      url = url.replace(':documentId', documentId);
      $.ajaxSetup({
          headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
       });
    var files = $('#'+id)[0].files;
    var form_data = new FormData();              
    form_data.append('documentFile', files[0]);
    form_data.append('documentTypeRequired', documentType);
    var documentTypeData='';
    if(documentType) documentTypeData= $('#'+documentTypeId).val();
    form_data.append('documentType', documentTypeData);
      $.ajax({
          url: url,
          data: form_data,
          type: 'POST',
          processData: false,
          contentType: false,
           success : function(data){
              $("#"+id).val('');
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
                    if(data.data.documentFile) $('#documentDiv_'+data.data.documentId).html('<a id="uploadedFile_'+data.data.documentId+'" href="data:application/pdf;base64,'+data.data.documentFile+'" download class="btn fs-18"><i class="uil-eye"></i></a>');
                    toastr.success('Documents uploaded succesfully');
                  }
               }
          },
          error:function (response) {
              let data = response.responseJSON;
              toastr.error(data);
          }
       });
}
</script>
@endsection