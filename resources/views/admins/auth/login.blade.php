<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="flex justify-content-end">
        <div class="position-fixed m-2 " id="alerts"
            style="right: 0;top: 0; z-index: 99999; border-radius: 10px;  box-shadow: 3px 3px 6px #0000009e; ">
        </div>
    </div>
    <div class="login-box " style="width: 380px">
        <div class="login-logo">
            <a href="#"><b>Demo</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in Admin</p>

                <form action="{{ route('admin.login') }}" autocomplete="off" method="post" autocomplete="off"
                    redirect="{{ url('admin/dashboard') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value=""
                            autocomplete="off" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            autocomplete="new-password" placeholder="Enter Password" value="">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-8">
                            {{-- <div class="icheck-primary">
                                <a href="{{ route('admin.forget-password') }}" class="dropdown-item">Forget Password</a>
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('dist/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
</body>

</html>
