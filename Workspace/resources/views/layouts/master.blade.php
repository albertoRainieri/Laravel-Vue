<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'E-commerce platform') }}</title>


  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper" id="app" style=" padding: 10px">


{{--  <nav class="main-header navbar navbar-expand bg-blue navbar-dark border-bottom">--}}
    <nav class="navbar navbar-dark navbar-expand bg-primary">

    <!-- Left navbar links -->

    <ul class="navbar-nav">

        <li class="nav-item">

            <a href="{{ url('/Dashboard') }}">
                <h4 class="nav-link active" aria-current="page" style="padding-right: 35px">Home</h4>
            </a>
        </li>

        <li class="nav-item" v-if="$gate.user.type == 'user' || $gate.user.type == 'admin'" style="padding-right: 35px">
            <a href="{{ url('/PersonalArea') }}">
                <h4 class="nav-link active" aria-current="page">Personal Area User</h4>
            </a>
        </li>

        <li class="nav-item" v-if="$gate.user.type == 'supplier' || $gate.user.type == 'admin'" style="padding-right: 35px">
            <a href="{{ url('/products') }}">
                <h4 class="nav-link active" aria-current="page" >Personal Area Supplier</h4>
            </a>
        </li>

        <li class="nav-item dropdown" v-if="$gate.user.type == 'admin'" style="padding-right: 35px">
                <h4 class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                    Settings Admin
                </h4>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ url('/category') }}">Category</a>
                <a class="dropdown-item" href="{{ url('/tag') }}">Tag</a>
                <a class="dropdown-item" href="{{ url('/developer') }}">Developer</a>
                <a class="dropdown-item" href="{{ url('/users') }}" >
                    Users List
                </a>
            </div>
        </li>
    </ul>
        <ul class="navbar-nav" style="padding-left: 800px">
        <li class="nav-item">
            <h6 class="nav-link active" aria-current="page" style="padding-bottom: 0px">
                Hi {{ Auth::user()->name }}
            </h6>

            <a href="{{ url('/logout') }}" class="btn btn-default btn-flat float-right"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <h4 class="nav-link active" aria-current="page" style="padding-top: 0px">
                    Logout
                </h4>
            </a>
            <form id="logout-form" action="{{ url('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>

        </li>

    </ul>
    <!-- SEARCH FORM -->




  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
{{--  <aside class="main-sidebar sidebar-dark-primary elevation-4">--}}
{{--    <!-- Brand Logo -->--}}
{{--    <router-link to="/dashboard" class="brand-link">--}}
{{--      <img src="{{ asset('/images/logo.png') }}" alt="The Logo" class="brand-image img-circle elevation-3"--}}
{{--           style="opacity: .8">--}}
{{--      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>--}}
{{--    </router-link>--}}

{{--    <!-- Sidebar -->--}}
{{--    <div class="sidebar">--}}
{{--      <!-- Sidebar user panel (optional) -->--}}
{{--        <router-link to="/profile">--}}
{{--          <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--              <div class="image">--}}
{{--                <img src="{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image">--}}
{{--              </div>--}}
{{--              <div class="info">--}}

{{--                  {{ Auth::user()->name }}--}}
{{--                  <span class="d-block text-muted">--}}
{{--                    {{ Ucfirst(Auth::user()->type) }}--}}
{{--                  </span>--}}
{{--              </div>--}}
{{--          </div>--}}
{{--        </router-link>--}}

{{--      <!-- Sidebar Menu -->--}}
{{--      @include('layouts.sidebar-menu')--}}
{{--      <!-- /.sidebar-menu -->--}}
{{--    </div>--}}
{{--    <!-- /.sidebar -->--}}
{{--  </aside>--}}

  {{-- Content Wrapper. Contains page content --}}

    <!-- Main content -->
    <router-view></router-view>

    <vue-progress-bar></vue-progress-bar>

    {{-- /.content --}}

  {{-- /.content-wrapper --}}

  {{-- Main Footer --}}
{{--  <footer class="main-footer">--}}
{{--    --}}{{-- To the right --}}
{{--    <div class="float-right d-none d-sm-block">--}}
{{--      <b>Version</b> 3.0.0--}}
{{--    </div>--}}
{{--    --}}{{-- Default to the left --}}
{{--    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.--}}
{{--  </footer>--}}
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user())


</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
