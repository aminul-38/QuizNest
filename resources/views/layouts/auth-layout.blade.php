@include('includes.header')

<body>
    @include('auth.includes.navbar')

    @yield('content')

    @include('includes.footer')
</body>

@stack('scripts')

</html>