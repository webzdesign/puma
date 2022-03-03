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
<body>
    <div class="login-page" style="min-height: 434.433px;">


        <div class="login-box">
            <div class="login-logo">
                <a href="#" class="logo-icon"><b class='text-uppercase'>{{ config('app.name') }} </b>ADMIN</a>
            </div>

            <div class="card card-outline card-info">
                <div class="card-body login-card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-12 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <div class="input-group mb-1">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block btn-info">
                                    {{ __('Send Otp') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

@include('layouts.partials.footerscript')
<script>
    $(document).ready(function() {
        @if (Session::has('expired'))
            Swal.fire(
            '{{ $moduleName }}',
            '{!! session('expired') !!}',
            'error'
            )
        @endif


    });
</script>

</html>
