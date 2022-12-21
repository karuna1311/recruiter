<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-modal-label">Edit Qualification</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attachment-body-content">
                    <div class="card mb-0">
                     
                        <form role="form" id="updatequalificationform" method="PUT" action="{{ route('qualification.update',[base64_encode($data->id)]) }}" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')
                            <div class="row">
                                 <div class="col-md-6 mt-2 mb-1">
                                    <label for="qualificationtype">Qualification Type <br>पात्रता प्रकार</label>
                                    <select class="form-control select2" name="qualificationtype" id="editqualificationtype" onchange="qualificationtypechange($(this).val(),'yes')">
                                       
                                       @foreach($qualification_type_list as $key=>$value)
                                       <option value="{{ $key }}" {{ (isset($data->qualificationtype) && $data->qualificationtype== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach                                                             
                                    </select>
                                 </div>
                                 <div class="col-md-6 mt-2 mb-1">
                                    <label for="qualificationname">Name of Qualification <br>पात्रतेचे नाव</label>
                                    <select class="form-control select2" name="qualificationname" id="editqualificationname" onchange="qualificationnamechange($(this).val(),'yes')">
                                    @foreach($qualification_name_list as $key=>$value)
                                       <option value="{{ $key }}" {{ (isset($data->qualificationname) && $data->qualificationname== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach 
                                    </select>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6 mb-1">
                                    <label for="subject">Subject / Stream / Branch<br>विषय/प्रवाह/शाखा</label>
                                    <select class="form-control select2" name="subject" id="editsubjectId" >
                                        @foreach($subject_list as $key=>$value)
                                            <option value="{{ $key }}" {{ (isset($data->subject) && $data->subject== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-6 mb-1">
                                    <label for="state">State<br>राज्य</label>
                                       <select class="form-control select2" name="state" id="editstatecode" onchange="statechange($(this).val(),'yes')">  
                                       @foreach($state_list as $key=>$value)
                                            <option value="{{ $key }}" {{ (isset($data->state) && $data->state== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach                                   
                                       </select>                                    
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="form-group col-md-12 mb-1">
                                    <label for="universitycode" >Board / University<br>मंडळ / विद्यापीठ</label>
                                    <select class="form-control select2" name="university" id="edituniversitycode">
                                    @foreach($university_list as $key=>$value)
                                            <option value="{{ $key }}" {{ (isset($data->university) && $data->university== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach
                                    </select>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6 mb-1"><label >Qualification Status <br>पात्रता स्थिती</label>
                                    <select class="form-control" name="typeResult" id="edittypeResult" onchange="qual_status($(this).val(),'yes')">
                                       <option value="">SELECT</option>
                                       <option {{ (isset($data->typeResult) && $data->typeResult==='PASSED') ? 'selected' : '' }} value="PASSED">Passed</option>
                                       <option {{ (isset($data->typeResult) && $data->typeResult==='APPEARED') ? 'selected' : '' }} value="APPEARED">Appeared</option>
                                    </select>
                                 </div>
                                 <div class="col-md-6 mb-1">
                                    <label >Date of qualification completion<br>पात्रता पूर्ण होण्याची तारीख</label>
                                    <input type="date"  name="doq" id="editDateofQualification" class="form-control" {{ $data->typeResult==='APPEARED' ? 'disabled' : " "}} value="{{ old('doq',isset($data->doq) ? $data->doq : '' ) }}">   
                                 </div>
                            </div>
                            <div class="row">                            
                                 <div class="col-md-6 mt-3 mb-1">
                                    <label >Attempts<br>प्रयत्न</label>
                                    <input type="text" class="form-control" name="attempts" id="editattempts" value="{{ old('attempts',isset($data->attempts) ? $data->attempts : '' ) }}">
                                 </div>
                                
                                
                            </div>
                            <div class="row">                               
                                 <div class="col-md-6  mb-1">
                                    <label >Class / Grade<br>वर्ग / श्रेणी</label>
                                    <select class="form-control select2" name="classGrade" id="editclassGradeLookupId"  >                                    
                                    @foreach($grade_list as $key=>$value)
                                            <option value="{{ $key }}" {{ (isset($data->classGrade) && $data->classGrade== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-6 mb-1">
                                    <label >Mode<br>मोड</label>
                                    <select class="form-control select2" name="mode" id="editmodeLookupId" >  
                                    @foreach($mode_list as $key=>$value)
                                            <option value="{{ $key }}" {{ (isset($data->mode) && $data->mode== $key) ? 'selected' : ''}}> {{ $value }}</option>   
                                       @endforeach                                  
                                    </select>
                                 </div>
                            </div>
                            <div class="row">                          
                                 <div class="col-md-6 mb-1">
                                       <label >Compulsory Subjects<br>अनिवार्य विषय</label>
                                       <input type="text" class="form-control" name="compulsorySubjects" id="editcompulsorySubjects" value="{{ old('compulsorySubjects',isset($data->compulsorySubjects) ? $data->compulsorySubjects : '' ) }}">
                                 </div>
                                 <div class="col-md-6 mb-1">
                                       <label >Optional Subjects<br>ऐच्छिक विषय</label>
                                       <input type="text" class="form-control" name="optionalSubjects" id="editoptionalSubjects" value="{{ old('optionalSubjects',isset($data->optionalSubjects) ? $data->optionalSubjects : '' ) }}">
                                 </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6 mt-3 mb-1">
                                    <label >Percentage / CGPA (For Grade add respective percentage value)<br>टक्केवारी / CGPA (श्रेणीसाठी संबंधित टक्केवारी मूल्य जोडा)</label>
                                    <input type="text" class="form-control" name="percentage" id="editpercentageGrade" value="{{ old('percentage',isset($data->percentage) ? $data->percentage : '' ) }}">
                                 </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="editqualificationsubmit" class="btn btn-warning">Update Qualification</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                           