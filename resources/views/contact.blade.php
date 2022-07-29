<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('include.head')
    </head>
    <body class="antialiased">
         @include('include.TopNav')
         <div class=" content-fixed content-auth">
            <div class="container">
             <div class="row contactDetails mt-5">
                 <div class="col-md-4 text-center">
                    <div class="card">
                         <i class="fas fa-home"></i> 
                         <h5>Office Adddress</h5>
                         <p>8th Floor, New Excelsior Building, A. K. Nayak Marg, Fort, Mumbai- 400 001</p>
                    </div>
                 </div>
                 <div class="col-md-4 text-center">
                    <div class="card">
                         <i class="fas fa-envelope"></i> 
                         <h5>Email Adddress</h5>
                         <p><a href="mailto: support-online@cet-cell.gov.in"> support-online@cet-cell.gov.in</a></p>
                    </div>
                 </div>
                 <div class="col-md-4 text-center">
                    <div class="card">
                         <i class="fas fa-phone"></i>
                         <h5>Phone </h5>
                         <p><a href="tel:18001234275">18001234275</a><br>
                            <a href="tel:7303821822">7303821822</a>
                         </p>
                    </div>
                 </div>
             </div>
         </div>
         </div>
        @include('include.footer')
    </body>
</html>
