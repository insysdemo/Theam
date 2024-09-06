@extends('admins.layouts.app')
@section('title', 'Admin | Permission')
@section('nav-link')
    <a href="#" class="nav-link disabled">Permission</a>
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
                            {{-- @if (Auth::guard('admin')->user()->can('Permission delete'))
                                @include('admins.common.newMuldeletebtn', [
                                    'url' => route('permissions.multidestroy'),
                                    'moduleName' => 'permission'
                                ])
                            @endif --}}
                            <h3 class="ml-auto">Permission</h3>
                            @if (Auth::guard('admin')->user()->can('Permission create'))
                                <button type="button" class="btn btn-primary ml-auto" onclick="createPermission(this)"
                                    data-target="commonModal">Create</button>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="permissions" class="table table-striped display nowrap " style="width:100%">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>
                                            <input type="checkbox" class="w-2 h-2 check-all" />
                                        </th>
                                        <th>Permission</th>
                                        <th>Created At</th>
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
    <script src="{{ asset('assets/admin/permission/index.js') }}"></script>
@endsection
