<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.layouts.header')
    </head>
    <body>
        @include('admin.layouts.topbar')

        @include('admin.layouts.sidebar')

        @yield('content')

        @include('admin.layouts.footer')
    </body>

</html>