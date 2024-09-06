
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('permissions.update',base64_encode($permission->id)) }}"
                            method="POST" id="formedit">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Permission Name</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="name" name="permission"
                                    autocomplete="off" autofocus value="{{ $permission->name }}"
                                    placeholder="Enter permission name" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>