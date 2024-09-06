<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include('admins.layouts.styles')
    @yield('style')
    {{-- <style>
        .dark-form-input:focus {
            background-color: #454d55 !important;
            color: white !important
        }
        .dark-form-input::placeholder {
            color: white;
        }
        .btn-sidebar:hover i {
            color: white;
            transition: all 5s;
        }
    </style> --}}

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="flex justify-content-end">
        <div class="position-fixed m-2 " id="alerts"
            style="right: 0; z-index: 99999; border-radius: 10px;  box-shadow: 3px 3px 6px #0000009e; ">
        </div>
    </div>


    <div class="wrapper">
        <!-- Navbar -->
        <div class="container-fluid">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/admin/dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        @yield('nav-link')
                    </li>
                    @php
                       
                    @endphp
                </ul>


                <div class="m-auto">

                    <div class="nav-item d-none d-sm-inline-block">
                        <h3 class="header-main-role-name">
                            
                        </h3>
                    </div>

                </div>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            {{ Auth::user()->name }} <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <a href="{{ route('admin.change-password') }}" class="dropdown-item">Change Password</a> --}}
                            <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="Default Profile Image"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ auth()->user()->name }}</span>

            <!-- Sidebar -->
            <div class="sidebar">
                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control dark-form-input form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}
                @include('admins.layouts.sidebar')
            </div>
            <!-- /.sidebar -->
        </aside>



        <!-- Content Header (Page header) -->
        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 w-100 mx-auto">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admins.layouts.footer')
    </div>

    @include('admins.layouts.scripts')
    <script>
        $('select.form-control').select2();
        var base_url = "{{ url('/') }}";
        var token = "{{ csrf_token() }}";
    </script>
    @yield('script')
</body>

</html>
