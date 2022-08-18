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
                              <legend>Available Post </legend>
                             <div>
                                <table class="table  table-bordered table-responsive w-100">
                                   <thead class="thead-light">
                                      <tr>
                                         <th>Sr. No.</th>
                                         <th>Post Name</th>
                                         <th>Post Count</th>
                                         <th>Remark</th>
                                         <th>Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                    <tr>
                                      <td>1.</td>
                                      <td>Deputy General Manager <br><span class="text-muted">उप महाव्यवस्थापक</span> </td>
                                      <td>1</td>
                                      <td>SC Candidate are not eligible</td>
                                      <td>-</td>
                                   </tr>
                                   <tr>
                                      <td>2.</td>
                                      <td>Assistant General Manager<br><span class="text-muted">सहाय्यक महाव्यवस्थापक</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>3.</td>
                                      <td>Assistant General Manager (Chief Compliance Officer)<br><span class="text-muted">सहाय्यक महाव्यवस्थापक (मुख्य अनुपालन अधिकारी)</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>4.</td>
                                      <td>Senior Manager (Chief Risk Officer)<br><span class="text-muted">वरिष्ठ व्यवस्थापक (मुख्य जोखीम अधिकारी)</span> </td>
                                      <td>1</td>
                                      <td>SC Candidate are not eligible</td>
                                      <td>-</td>
                                   </tr>
                                   <tr>
                                      <td>5.</td>
                                      <td>Senior Manager (Internal Audit)<br><span class="text-muted">वरिष्ठ व्यवस्थापक (अंतर्गत लेखा तपासणी)</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>6.</td>
                                      <td>Branch Manager<br><span class="text-muted">शाखा व्यवस्थापक</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>7.</td>
                                      <td>Assistant Manager (Internal Audit)<br><span class="text-muted">सहाय्यक व्यवस्थापक (अंतर्गत लेखा तपासणी)</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>8.</td>
                                      <td>Assistant Manager <br><span class="text-muted">सहाय्यक व्यवस्थापक </span> </td>
                                      <td>10</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>9.</td>
                                      <td>Assistant Manager (IT Support)<br><span class="text-muted">सहाय्यक व्यवस्थापक (आय्.टी. सपोर्ट)</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
                                   <tr>
                                      <td>10.</td>
                                      <td>Assistant Manager (IT Networking)<br><span class="text-muted">सहाय्यक व्यवस्थापक (आय्.टी. नेटवर्कींग)</span> </td>
                                      <td>1</td>
                                      <td>Eligible For This Post</td>
                                      <td><button type="button" class="btn btn-apply btn-success mb-1"><i class="uil-check"></i> Apply</button></td>
                                   </tr>
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
            @include('include.userFooter')
         </div>
      </div>
      @include('include.user.UserCustomJs')
@endsection