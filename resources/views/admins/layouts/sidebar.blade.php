  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
                {{-- <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link @if (request()->segment(1) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/admin/roles') }}" class="nav-link @if (request()->segment(1) == 'roles') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Role</p>
                  </a>
              </li> --}}

            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link @if (Request::is('admin/dashboard')) active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            {{-- @dd(Auth::user())  ; --}}
            {{-- @dd(Auth::guard('admin')->user()); --}}
            @can('Role access')
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link @if (Request::is('roles*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Role</p>
                </a>
            </li>
            @endcan

            @can('Permission access')
            <li class="nav-item">
                <a href="{{ route('permissions.index') }}" class="nav-link @if (Request::is('permissions*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Permissions</p>
                </a>
            </li>
            @endcan

            @can('Rolehaspermission access')
            <li class="nav-item">
                <a href="{{ route('role-has-permission.index') }}" class="nav-link @if (Request::is('role-has-permission*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Access</p>
                </a>
            </li>
            @endcan
            @can('Users access')
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link @if (Request::is('user*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>User</p>
                </a>
            </li>
            @endcan


            @php
                // $admin = auth()->guard('admin')->user();
            @endphp

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>