@extends('admins.layouts.app')
@section('title', 'Admin | Rolehaspermission')
@section('nav-link')
    <a href="#" class="nav-link disabled">Rolehaspermission</a>
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
                        <div class="card-header text-center">


                            <h3 class="ml-auto">Rolehaspermission</h3>

                            {{-- <a href="{{ route('role-has-permission.create') }}"
                                class="ml-auto btn btn-primary">
                                Create
                            </a> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="roleHasPermission" class="table table-striped display nowrap " style="width:100% ; min-width :1050px">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>
                                            <input type="checkbox" class="w-2 h-2 check-all" />
                                        </th>
                                        <th>Role</th>
                                        <th class="w-75">Permission</th>
                                        <th>Last Modified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class=" overflow-stick" >


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
    <script src="{{ asset('assets/admin/role_has_permission/index.js') }}"></script>
@endsection
