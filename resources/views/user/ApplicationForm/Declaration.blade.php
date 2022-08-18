@extends('layouts.UserDashboard')
@section('content')
               <div class="row">
                  <div class="col-12">
                     <div class="page-title-box">
                        <!--  <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                               <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                               <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                               <li class="breadcrumb-item active">CRM</li>
                           </ol>
                           </div> -->
                        <h4 class="page-title">Application Form</h4>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="tab-content">
                        <form>
                           <fieldset class="form-fieldset">
                              <legend>Declaration  </legend>
                              <div class="row form-group br-bt-1 ">
                                 <div class=" col-md-12">
                                    <div class="custom-control custom-checkbox mb-2 d-flex" >
                                       <input type="checkbox" name="1" class="custom-control-input declarecheckbox" id="1">
                                       <label class="custom-control-label" for="1"> I, hereby, solemnly and sincerely affirm that each and every statement made and the entire information filled in the above online application form is true and correct to the best of my knowledge. <br> <span class="text-muted">मी, याद्वारे, गंभीरपणे आणि प्रामाणिकपणे प्रतिज्ञा करतो की वरील ऑनलाइन अर्जामध्ये केलेले प्रत्येक विधान आणि भरलेली संपूर्ण माहिती माझ्या माहितीप्रमाणे सत्य आणि बरोबर आहे.</span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2 d-flex">
                                       <input type="checkbox" name="2" class="custom-control-input declarecheckbox" id="2">
                                       <label class="custom-control-label" for="2"> I have not concealed any material information, however if any information submitted herein is found fraudulent, incorrect or untrue, I understand that I am liable to criminal prosecution and I also agree to forgo my seat in Medical Postgraduate course. I also understand that my selection and admission to the course is also liable to be cancelled. <br> <span class="text-muted">मी कोणतीही भौतिक माहिती लपवलेली नाही, तथापि येथे सादर केलेली कोणतीही माहिती फसवी, चुकीची किंवा असत्य आढळल्यास, मी समजतो की मी फौजदारी खटला भरण्यास जबाबदार आहे आणि मी वैद्यकीय पदव्युत्तर अभ्यासक्रमातील माझी जागा सोडण्यास देखील सहमत आहे. मी हे देखील समजतो की माझी निवड आणि अभ्यासक्रमासाठीचा प्रवेश देखील रद्द केला जाऊ शकतो.</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2 d-flex">
                                       <input type="checkbox" name="3" class="custom-control-input declarecheckbox" id="3">
                                       <label class="custom-control-label" for="3"> I have carefully read the rules & regulations of The Munciple Co-Op. Bank LTD 2021 brochure and I agree to abide by them. I hereby accept in entirely the legality, validity and correctness of these rules. I understand by submitting this application I have accepted the correctness, validity and/or justifiability of all these and that. Had I not accepted the correctness and validity of these rules I would not have submitted this application and further that it will not be open hereinafter to challenge and / or question validity and / or correctness of any rule or part thereof. <br> <span class="text-muted">मी The Munciple Co-Op. Bank LTD 2021 ब्रोशरचे नियम आणि नियम काळजीपूर्वक वाचले आहेत आणि मी त्यांचे पालन करण्यास सहमत आहे. मी याद्वारे या नियमांची संपूर्ण कायदेशीरता, वैधता आणि शुद्धता स्वीकारतो. मला समजते की हा अर्ज सबमिट करून मी या सर्वांची शुद्धता, वैधता आणि/किंवा न्याय्यता स्वीकारली आहे. जर मी या नियमांची शुद्धता आणि वैधता स्वीकारली नसती तर मी हा अर्ज सादर केला नसता आणि पुढे असे केले असते की यापुढे कोणत्याही नियमाच्या किंवा त्याच्या भागाच्या वैधतेला आणि/किंवा शुद्धतेला आव्हान देण्यासाठी आणि/किंवा प्रश्न करण्यासाठी खुला राहणार नाही.</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2 d-flex">
                                       <input type="checkbox" name="4" class="custom-control-input declarecheckbox" id="4">
                                       <label class="custom-control-label" for="4">I undertake to upload all the required Documents at the time of Registration, failing which I understand that my claim for selection shall not be granted. <br><span class="text-muted">मी नोंदणीच्या वेळी सर्व आवश्यक दस्तऐवज अपलोड करण्याचे वचन देतो, त्यात अयशस्वी झाल्यास निवडीसाठी माझा दावा मंजूर केला जाणार नाही हे मला समजते.</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2 d-flex">
                                       <input type="checkbox" name="5" class="custom-control-input declarecheckbox" id="5">
                                       <label class="custom-control-label" for="5">I undertake to submit all the required original certificates at the time of Document Verification as well as at the time of admission to a course/college as per the rules, failing which I understand that my claim for selection shall not be granted. <br><span class="text-muted">मी दस्तऐवज पडताळणीच्या वेळी तसेच नियमांनुसार अभ्यासक्रम/कॉलेजच्या प्रवेशाच्या वेळी सर्व आवश्यक मूळ प्रमाणपत्रे सादर करण्याचे वचन घेतो, असे न झाल्यास माझा निवडीचा दावा मंजूर केला जाणार नाही हे मला समजते.</span></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row form-group br-bt-1 ">
                                 <table class="table table-bordered img_table">
                     <tr>
                        <td valign="top" style="width: 50%;">
                           <ul class="insruction">
                              <li><b>Instruction For Photograph:</b></li>
                              <li>Size of photograph must be less than 35 kb.</li>
                              <li>Height of photograph must be between 250 pixel and 320 pixel.</li>
                              <li>width of photograph must be between 150 pixel and 220 pixel.</li>
                           </ul>
                        </td>
                        <td valign="top">
                           <ul>
                              <li ><b>Upload Photo</b></li>
                              <td style="border:solid 1px #CCCCCC;"><a href="" onClick="document.getElementById('uploadImage').click(); return false" >
                              <img id="uploadPreview" width="80" height="90" src="assets/img//no-profile-pic-m.gif"></a><input id="uploadImage" type="file" name="Img[]" onChange="PreviewImage();" hidden><h5 class="errorHide" id="err_photo"></h5></td>
                        </ul>
                        </td>
                     </tr>
                     <tr>
                        <td valign="top" style="width: 50%;">
                           <ul class="insruction">
                              <li><b>Instruction For Signature</b></li>
                              <li>Size of signature must be less than 30 kb.</li>
                              <li>Height of signature must be between 100 pixel and 180 pixel.</li>
                              <li>width of signature must be between 150 pixel and 220 pixel.</li>
                           </ul>
                        </td>
                        <td valign="top">
                           <ul>
                              <li><b>Upload Sign</b></li>
                        <td style="border:solid 1px #CCCCCC;"><a href="" onClick="document.getElementById('uploadImageSign').click(); return false" ><img id="SuploadPreview" width="100" height="50" src="assets/img/Sign.gif"
                           ></a><input id="uploadImageSign" type="file" name="Img[]" onChange="SPreviewImage();" hidden><h5 class="errorHide" id="err_sign"></h5></td>
                        </ul>
                        </td>         
                     </tr>
                  </table>
                              </div>
                              <div class="row form-group">
                                 
                                 <div class="col-md-12 text-right">
                                    
                                    <button type="button" class="btn btn-success mb-3">Save And Next</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            @include('include.userFooter')
         </div>
      </div>
      <script type="text/javascript">
         function PreviewImage(){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function (oFREvent){
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
};

function SPreviewImage(){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImageSign").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("SuploadPreview").src = oFREvent.target.result;
    };
};
      </script>
@include('include.user.UserCustomJs')
@endsection