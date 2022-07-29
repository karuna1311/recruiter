<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       <style type="text/css">
         @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');
         body { margin: 1px; }
         .devnagari{font-family: freeserif;}
          .contactDetails h4{text-transform: uppercase;font-size: 14px;}
          .contactDetails p{font-size: 13px;margin-bottom: 0;}
          .table-dark {
                color: #fff;
                background-color: #3b4863;
            }
            .text-right{text-align: right;}
            table tr td{padding: 10px;vertical-align: middle!important;}

            table{width: 100%;border-collapse: collapse;}
            body{border: 1px solid #000;padding: 16px;}
            table th{border: 1px solid #fff;background: #ddd;padding: 4px;font-size: 14px;color: #000;text-transform: uppercase;text-align: center;font-family: 'Open Sans', sans-serif;}
            table td{border: 1px solid #ddd;padding: 4px;font-size: 12px;color: #000;text-align: left;font-family: 'Open Sans', sans-serif;font-weight: 400!important;}
            .widthBd td{width: 16.66%;}
            table tr{border: 1px solid #ddd;}
            .tableData tr td, th{text-align: center;}
         </style>
    </head>
    <body class="antialiased">
         <div class=" content-fixed content-auth">
            <div class="container">
             <div class="bg-white pd-20">
                  <table class="bd">
                     <tr>
                        <td><img src="{{ url('/') }}/LoginAssets/images/pdfback.jpg" class="w-100"></td>
                     </tr>
                  </table>
                  <br>
                  <table class="contactDetails bd w-100">
                     <tr>
                        <td colspan="2" style="text-align:center;">
                           <h4 style="text-transform: uppercase;font-weight: 400;margin-bottom: 6px;"><b>Contact Details</b></h4>
                        </td>
                        <td colspan="2" style="text-align:center;">
                           <h4 style="text-transform: uppercase;font-weight: 400;margin-bottom: 6px;"><b>NEET Details</b></h4>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <b>Name:</b>
                        </td>
                        <td>
                           {{$userData['name']}}
                        </td>
                        <td>
                           <b>Application No:</b>
                        </td>
                        <td>
                           {{$userData['neetappno']}}
                        </td>
                        <tr>
                        <td>
                           <b>Mobile No.</b>: 
                           </td>
                        <td>
                           {{$userData['mobile']}}
                        </td>
                        <td><b>Roll No.:</b></td>
                        <td>{{$userData['rollno']}}</td>
                     </tr>
                     <tr>
                        <td>
                           <p><b>Email</b>: </td>
                         <td>{{$userData['email']}}
                        </td>
                         <td>
                          
                         <b>Date Of Birth:</b></td>
                         <td>{{$userData['dob']}}
                     </tr>
                  </table>
                  <br>
                  <table class="table table-bordered tableData">
                     <thead class="table-dark text-center" style=" color: #fff;background-color: #3b4863;">
                       <tr>
                           <th>Sr. No.</th>
                           <th>Session Name</th>
                           <th>Order Id</th>
                           <th>Cetcell <br> Application No</th>
                           <th>Fees Type</th>
                           <th>Amount</th>
                       </tr>
                     </thead>
                     <tr>
                        <td rowspan="2" class="text-right">1.</td>
                        <td rowspan="2">{{$session->session_name}}</td>
                        <td rowspan="2" class="text-right">{{$paymentData->order_id}}</td>
                        <td rowspan="2">{{$paymentData->id}}</td>
                        <td style="text-align: right;">Application Fee</td>
                        <td style="text-align: right;"><b>&#8377; {{$session->fee_json}}/-</b></td>
                     </tr>
                     <tr>
                        <td style="text-align: right;">Security Deposite</td>
                        <td style="text-align: right;"><b>&#8377; {{$paymentData->amount - $session->fee_json}}/-</b></td>
                     </tr>
                     <tr>
                        <td colspan="5"  style="text-align: right;">Total:</td>
                        <td style="text-align: right;">&#8377; <b>{{$paymentData->amount}}/-</b></td>
                     </tr>
                  </table>
             </div>
         </div>
         </div>
    </body>
</html>
