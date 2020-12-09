<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.components.header')

<body>
    <div id="app">
        @include('layouts.components.navbar')
        {{-- @include('layouts.components.messages') --}}
        <div class="container mt-3">
            @include('flash::message')
            @include('layouts.components.messages')
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
</body>

</html>