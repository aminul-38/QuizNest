@include('includes.header')

<body>
    @include('includes.navbar')

    @include('includes.quiz-card')

    @yield('content')

    @include('includes.footer')
</body>

@stack('scripts')

</html>