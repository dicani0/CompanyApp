<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.components.header')

<body>
    <div id="app">
        @include('layouts.components.navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>