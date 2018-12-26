<!DOCTYPE html>
<html lang="en">
    <head>
        @include('user.layouts.header')
    </head>
    <body>
        @include('user.layouts.topbar')
        @yield('content')
        @include('user.layouts.footer')
    </body>

</html>