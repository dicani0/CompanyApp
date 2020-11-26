<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.components.header')

<body>
    <div id="app">
        @include('layouts.components.navbar')
        {{-- @include('layouts.components.messages') --}}
            @include('flash::message')
            @include('layouts.components.messages')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>

</html>