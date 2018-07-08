<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        @include('partials._nav')
        <div class="container">
            @include('partials._message')
            @yield('content')
        </div>
    </body>
</html>