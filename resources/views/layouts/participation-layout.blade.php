@include('includes.header')

<body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')
</body>

@stack('scripts')

</html>