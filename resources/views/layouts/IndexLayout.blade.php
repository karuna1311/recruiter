<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('include.head')
    </head>
    <body class="antialiased">
         @include('include.TopNav')
             @yield('content')
        @include('include.footer')
    </body>
</html>
