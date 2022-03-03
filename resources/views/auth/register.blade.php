<!DOCTYPE html>
<html lang="en" data-url-prefix="/" data-footer="true"
    data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<title>{{ config('app.name') }}</title>

<head>

    @include('layouts.partials.headerscript')
    <style>
        .logo-icon,
        .logo-icon b {
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
        }

    </style>
</head>

<body class="register-page" style="min-height: 464.983px;">
    <div class="register-box">
        <div class="register-logo">
            <a href="" class="logo-icon"><b>ADMIN </b>SIGNUP</a>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-body register-card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-1">
                        <label for="name" class="col-md-12 col-form-label text-md-end">Name</label>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="name" type="text" class="form-control " name="name" value="" required=""
                                    autocomplete="name" autofocus="">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="email" class="col-md-12 col-form-label text-md-end">E-Mail Address</label>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control " name="email" value="" required=""
                                    autocomplete="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="password" class="col-md-12 col-form-label text-md-end">Password</label>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control " name="password" required=""
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="password-confirm" class="col-md-12 col-form-label text-md-end">Confirm
                            Password</label>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required="" autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col offset-md-4">
                            <button type="submit" class="btn btn-primary w-50">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->



    @include('layouts.partials.footerscript')
</body>

</html>
