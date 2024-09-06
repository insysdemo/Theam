@extends('admins.layouts.app')
@section('title', 'Admin | Roles')
@section('nav-link')
    <a href="#" class="nav-link disabled">Roles</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h3 class="ml-auto">User</h3>
                            @if (Auth::guard('admin')->user()->can('Users create'))
                                <a href="{{ route('users.create') }}">
                                    <button type="button" class="btn btn-primary ml-auto">Create </button>
                                </a>
                            @else
                                @dd('Permission not granted');
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="users" class="table table-striped display nowrap " style="width:100%">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>
                                            <input type="checkbox" class="w-2 h-2 check-all" />
                                        </th>
                                        <th>User Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class=" overflow-stick">


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->




    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/user/index.js') }}"></script>
@endsection
