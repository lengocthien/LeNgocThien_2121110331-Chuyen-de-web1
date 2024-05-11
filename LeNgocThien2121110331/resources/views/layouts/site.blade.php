<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @yield('header')
</head>
<body>
    <head>Header</head>
    <main>
        @yield('content')
    </main>
    <footer>Footer</footer>
    @yield('footer')
</body>
</html>
