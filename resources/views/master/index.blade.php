
@extends('layouts.app')

@section('content')

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
            @include('components.preloader')
            @include('components.navbar')
            @include('components.sidebar')
            @yield('mainContent')
            @include('components.footer')
    </div>
</body>

@endsection
