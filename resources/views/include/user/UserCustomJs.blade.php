 <script type="text/javascript">

function valueFlush(arryOfElements)
  {
     $.each(arryOfElements, function(key, val) {
         $('#'+val).val('');
     });
   }

function getLocation(selectId,requiredEntity,state='',district='',subDistrict='')
{
   $.ajaxSetup({
      headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
  $.ajax({
      url : "{{route('location.index')}}",
      data: {requiredEntity:requiredEntity,state:state,district:district,subDistrict:subDistrict},
      type : 'post',
      success : function(data)
      {
        if (data.ValidatorErrors) {
          $.each(data.ValidatorErrors, function(index, jsonObject) {
            $.each(jsonObject, function(key, val) {
                toastr.error(val);
            });
            return false;
          });
        }
        if(data.locationData)
        {
          
          $('#'+selectId).empty();
          $.each(data.locationData, function(key, value) {  
              $('#'+selectId).append('<option value="'+key+'">'+value+'</option>');  
          });
        } 
      },
      error:function (response) {
        toastr.error(response);
      }
  });
}
function serialiseData(formId){
  values = jQuery('#'+formId).serializeArray();
  values = values.concat(
          jQuery('#'+formId+' input[type=checkbox]:not(:checked)').map(
                  function() {
                      return {"name": this.name, "value": 0}
                  }).get()
  );
  return values;
}
</script>
