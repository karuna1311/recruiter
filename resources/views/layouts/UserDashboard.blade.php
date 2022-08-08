<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      @include('include.user.UserCss')
      <style>
         .asrtick{
            color:red
         }
      </style>
   </head>
   <body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>
      <div class="wrapper">
         @include('include.user.UserMenu')
         <div class="content-page">
            <div class="content">
               @include('include.user.UserHeader')
              	@yield('content')
            </div>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;" autocomplete="off">
               {{ csrf_field() }}
            </form>
            @yield('js')
            @include('include.user.UserJs')
         </div>
      </div> 
   </body>
</html>