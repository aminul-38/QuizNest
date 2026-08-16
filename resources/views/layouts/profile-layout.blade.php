@include('includes.header')

<body>
    @include('users.includes.navbar')

    @yield('content')

    @include('includes.footer')
</body>

@stack('scripts')

</html>