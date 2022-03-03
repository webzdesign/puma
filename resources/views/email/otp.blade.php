<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    @include('layouts.partials.headerscript')

    <style>
        .headLogo {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #294677;
            font-family: 'PT Sans', sans-serif;
            letter-spacing: 0.5px;
            margin-top: 3px;
        }

        .btn {
            background-color: #0d6efd;
            padding: 7px 20px;
            font-size: 12px;
            color: #fff;
        }

        table th,
        td {
            padding: 10px;
        }

    </style>
</head>

<body style="color: #718096;">
    <div class="container content">
        <div class="justify-content-center d-flex">
            <span class="headLogo">
                {{ $company }}
            </span>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-10 card">
                <div class="card-body">
                    {{-- <h1 style="color: #007bff;background-color: transparent;text-transform:capitalize;"> </h1> --}}
                    <div style="text-transform:capitalize;">
                        <h2>
                            Hello {{ $name }},
                        </h2>
                        <p>You are receiving this email because we received a login request for your account.</p>
                        <b>
                            Your Otp Is {{ $otp }}
                        </b>

                        <p>
                            This otp will expire in 5 minutes.

                        </p>
                    </div>


                    <div style="">
                        <p>Regards,<br />
                            <b>{{ $company }} </b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('layouts.partials.footerscript')
</body>

</html>
