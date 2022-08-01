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
       <form>
                           <fieldset class="form-fieldset">
                              <legend>Experiance Information <span class="text-muted">शैक्षणिक माहिती</span></legend>
                              <div class="row" style="margin-top: 10px;">
                                 <div class="col-md-3 mt-3 mb-3">
                                    <label >Employment (Present / Past) <span class="redColor">*</span></label>
                                    <select class="form-control" name="typeEmploymentLookupId">
                                       <option value="">Select</option>
                                       <option value="1">Past</option>
                                       <option value="2">Present</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3">
                                    <label >Whether selected from MPSC? <span class="redColor">*</span></label>
                                    <select class="form-control" name="flgMpscSelection">
                                       <option value="">Select</option>
                                       <option value="true">Yes</option>
                                       <option value="false">No</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3">
                                    <label >Post Name <span class="redColor">*</span></label>
                                    <select class="form-control" name="postNameLookupId">
                                       <option value="">Select</option>

                                    </select>
                                 </div>
                                 <div class="col-md-3 mt-3"><label >Institution / Department / Organisation / Court <span class="redColor">*</span></label><input type="text" class="form-control" name="officeName" maxlength="500" value=""></div>
                                 <div class="col-md-3">
                                    <label style="float: left; width: 250px;">Is Office / Institution owned by Govt. of Maharashtra? <span class="redColor">*</span></label>
                                    <select class="form-control" name="flgOfficeGovOwned">
                                       <option value="">Select</option>
                                       <option value="true">Yes</option>
                                       <option value="false">No</option>
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-3" style="padding-top: 17px;"><label >Designation (Post Held) <span class="redColor">*</span></label><input type="text" class="form-control" name="designation" maxlength="200" value=""></div>
                                 <div class="col-md-3 mb-3" style="padding-top: 17px;">
                                    <label >5.6&nbsp;Nature Of Job <span class="redColor">*</span></label>
                                    <select class="form-control" name="jobNatureLookupId">
                                       <option value="">Select</option>
                                     
                                    </select>
                                 </div>
                                 <div class="col-md-3 mb-3" style="padding-top: 17px;">
                                    <label >Whether the post is Gazetted? <span class="redColor">*</span></label>
                                    <select class="form-control" name="flgGazettedPost">
                                       <option value="">Select</option>
                                       <option value="true">Yes</option>
                                       <option value="false">No</option>
                                    </select>
                                 </div>
                              </div>
                           </fieldset>
                           <br>
                           <fieldset class="form-fieldset">
                              <table class="table tableauto table-bordered table-responsive w-100">
                                 <thead class="thead-light">
                                    <tr>
                                       <th >Sr No</th>
                                       <th >Employment </th>
                                       <th >Name of Qualification</th>
                                       <th >Subject / Stream / Branch</th>
                                       <th >Board / University</th>
                                       <th >Date of qualification completion</th>
                                       <th >Attempts</th>
                                       <th >Percentage / CGPA (For Grade add respective percentage value)</th>
                                       <th >Number of academic months</th>
                                       <th >Class / Grade</th>
                                       <th >Mode</th>
                                       <th >Compulsory Subjects</th>
                                       <th >Optional Subjects</th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody style="font-size: 12px;">
                                    <tr>
                                       <td>1</td>
                                       <td>SSC</td>
                                       <td>SSC</td>
                                       <td></td>
                                       <td>State Board</td>
                                       <td>01/04/2010</td>
                                       <td>1</td>
                                       <td>56</td>
                                       <td>2</td>
                                       <td>Second Class</td>
                                       <td>Traditional / Regular</td>
                                       <td class="word-break">a</td>
                                       <td class="word-break">b</td>
                                     
                                    </tr>
                                 </tbody>
                              </table>
                           </fieldset>
                           <div class="row form-group  mt-3 ">
                              <div class="col-md-6 text-right"> 
                                 <button type="button" class="btn btn-success mb-1">Save And Next</button>
                              </div>
                           </div>
                        </form>
      </div>
   </div>
</div>
@endsection
@section('js')

@include('include.user.UserCustomJs')
@endsection