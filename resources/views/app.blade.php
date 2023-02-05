<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title', 'OnlineLibrary')</title>
    {{-- <link rel="stylesheet" href="http://laravel.itstep.kz:8080/_css/tailwind.css" /> --}}
    <link rel="stylesheet" href="{{ asset('/_css/tailwind.css') }}" />
    <style>
        *{margin: 10; padding: 0}
    </style>
    @stack('styles')
    @stack('scripts')
</head>
<body>
    <header>
        @include('components.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('components.footer')
    </footer>
</body>
</html>