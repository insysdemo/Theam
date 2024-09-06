<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('roles.update',base64_encode($role->id)) }}" method="POST" id="formedit">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Role Name</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="name" name="name" autocomplete="off" autofocus
                                    value="{{ $role->name }}" placeholder="Enter Role Name" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>