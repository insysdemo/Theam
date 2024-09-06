@extends('admins.layouts.app')
@section('title', 'Admin | Create Doctor')
@section('style')
@endsection
@section('nav-link')
    <a href="#" class="nav-link disabled">Add Doctor</a>
@endsection
<style>
    .invalid-feedback {
        display: block;
        color: red;
    }

    .is-invalid {
        border-color: red;
    }
</style>
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8  ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add User</h3>
                        </div>
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="Enter Name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="email">Email</label>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="Enter Email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="password">Password</label>

                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password">

                                      
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password">

                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="role">Select Role</label>
                                        <select name="role" id="role"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option value="">Choose a role</option>
                                            @foreach ($role as $r)
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="image">Image</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" id="image">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="image-preview" style="margin-top: 10px;">
                                            <!-- The image will be displayed here -->
                                            <img id="preview" src="" alt="Image Preview" style="max-width: 100%; display: none;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.getElementById('image').addEventListener('change', function() {
            var image = document.getElementById('image').files[0];

            if (image) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Get the image element and set the src attribute to the file URL
                var preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';  // Make the image visible
            };
            reader.readAsDataURL(image);
        } else {
            // Hide the preview image if no file is selected
            document.getElementById('preview').style.display = 'none';
        }
        });
    </script>
@endsection
