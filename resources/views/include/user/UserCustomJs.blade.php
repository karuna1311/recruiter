<script type="text/javascript">
   
//  $(document).ready(function() {
//       $(document).on('change','#qualificationtype',function() {
   
//          var Qualificationtype = $(this).val();
//          var encode = btoa(Qualificationtype);
         
//          var url = '{{ route("services.getQualificationName", ":Qualificationtype") }}';
//          url = url.replace(':Qualificationtype', encode);
//             $.ajax({
//                url: url,
//                type: 'get',
//                success : function(data){

//                   $('#qualificationname').empty();
//                   if(data){
//                         $.each(data, function(key, val) { 
//                         $('#qualificationname').append('<option value="'+key+'">'+val+'</option>');
//                      });
//                   }
//                },
//                error:function (response) {
//                   let data = response.responseJSON;
//                   toastr.error(data);
//                }
//             });
//          });
      

//    $(document).on('change','#qualificationname',function() {
//          var Qualificationname = $(this).val();
//          var encode = btoa(Qualificationname);
         
//          var url = '{{ route("services.getSubject", ":Qualificationname") }}';
//          url = url.replace(':Qualificationname', encode);
//             $.ajax({
//                url: url,
//                type: 'get',
//                success : function(data){

//                   $('#subjectId').empty();
//                   if(data){
//                         $.each(data, function(key, val) {
//                         $('#subjectId').append('<option value="'+key+'">'+val+'</option>');
//                      });
//                   }
//                },
//                error:function (response) {
//                   let data = response.responseJSON;
//                   toastr.error(data);
//                }
//             });
//    });


//    $(document).on('change','#statecode',function() {

//    var state = $(this).val();
//    var encode = btoa(state);
         
//          var url = '{{ route("services.getUniversityName", ":state") }}';
//          url = url.replace(':state', encode );
//             $.ajax({
//                url: url,
//                type: 'get',
//                success : function(data){
//                   $('#universitycode').empty();
//                   if(data){
//                         $.each(data, function(key, val) {
//                         $('#universitycode').append('<option value="'+key+'">'+val+'</option>');
//                      });
//                   }
//                },
//                error:function (response) {
//                   let data = response.responseJSON;
//                   toastr.error(data);
//                }
//             });
//    });
    
//    // $(document).click('#qualificationform',function(){
     
//          $('#qualificationform').validate({
            
//                rules: {            
//                   qualificationtype : "required",
//                   qualificationname : "required",
//                   state : "required",
//                   university : "required",
//                   typeResult : "required",
//                   doq : "required_if:typeResult,PASSED",
//                   attempts : "required_if:typeResult,PASSED"
//                   // percentage : "required_if:typeResult,PASSED",
//                   // courseDurations : "required_if:typeResult,PASSED",
//                   // classGrade : "required",
//                   // mode : "required"              
//                },
//                messages: {     
//                   qualificationtype : {
//                      required:"Please select Qualification Type"
//                   },
//                   qualificationname : {
//                      required:"Please select Qualification Name"
//                   },
//                   state : {
//                      required:"Please select State"
//                   },
//                   university : {
//                      required:"Please select University"
//                   },
//                   typeResult : {
//                      required:"Please select Qualification Status"
//                   },
//                   attempts : {
//                      required:"Please select Qualification Type"
//                   },
//                   percentage : {
//                      required:"Please select Qualification Type"
//                   },
//                   courseDurations : {
//                      required:"Please select Qualification Type"
//                   },
//                   classGrade : {
//                      required:"Please select Qualification Type"
//                   },
//                   mode : {
//                      required:"Please select Qualification Type"
//                   },   
//                   doq : {
//                      required:"Please select Date of Qualification Passed"
//                   }
//                },            
//                submitHandler: function (form) {
//                   $.ajax({
//                      url: "{{ route('qualification.store')}}",
//                      data: $(form).serialize(),
//                      type: 'POST',
//                         beforeSend: function() {
//                            alert('hi');
//             // setting a timeout
            
//                      },
//                      success : function(data){
//                         if (data.ValidatorErrors) {
//                            $.each(data.ValidatorErrors, function(index, jsoNObject) {
//                               $.each(jsoNObject, function(key, val) {
//                                  toastr.error(val);
//                               });
//                               return false;
//                            });
//                            }
//                            if (data.status) {
//                            if(data.status==='error') toastr.error(data.data);
//                            else if(data.status==='success'){
//                               toastr.success(data.data);
//                               //  window.location.replace();
//                               }
//                            }
//                      },
//                      error:function (response) {
//                         let data = response.responseJSON;
//                         toastr.error(data);
//                      }
//                   });
//                }
//          });
// });

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
