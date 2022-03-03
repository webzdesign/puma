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

<body class="login-page" style="min-height: 434.433px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="#" class="logo-icon"><b class='text-uppercase'>{{ config('app.name') }} </b>ADMIN</a>
        </div>

        <div class="card card-outline card-info">
            <div class="card-body login-card-body">

                <form method="POST" action="{{ route('checkOtp', $id) }}" id="form">
                    @csrf

                    <div class="row mb-3">
                        <label for="otp" class="col-md-12 col-form-label text-md-end">{{ __('Verify Otp') }}</label>

                        <div class="col-md-12">
                            <div class="input-group mb-1">
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"
                                    name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>

                                @error('otp')
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
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@include('layouts.partials.footerscript')

<script>
    $('#form').validate({
        rules: {
            otp: {
                required: true,
                number: true,
                rangelength: [6, 6]
            },
        },
        messages: {
            otp: {
                required: "Otp Is Required.",
                number: "Enter Valid Otp.",
                rangelength: "Otp Is Only 6 character.",
            },
        },
        errorPlacement: function(error, element) {
            element.parent('div').find('.invalid-feedback').hide();
            error.css('color', 'red').appendTo(element.parent("div").parent('div'));
        },
    });
</script>

</html>
