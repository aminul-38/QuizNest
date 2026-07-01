@include('includes.header')

<body>
    @include('users.includes.navbar')

    @include('components.profile-card')

    @yield('content')

    @include('includes.footer')
</body>

@stack('scripts')

</html>