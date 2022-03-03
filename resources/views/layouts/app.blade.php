<!DOCTYPE html>
<html lang="en" data-url-prefix="/" data-footer="true"
    data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }} - {{ config('subtitle','WEB') }}</title>

@include('layouts.partials.headerscript')

@yield('style')


<style>
    .preloader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        {{--  background: url({{ asset('public/assets/img/loader.gif') }}) 50% 50% no-repeat rgb(249, 249, 249);  --}}
        background: #fff no-repeat right top;
        background-size: 100% 100%;
        {{--  opacity: .8;  --}}
    }

</style>
</head>


{{-- @section('project_title', env('APP_NAME')) @endsection --}}
@section('project_title', config('app.name'))

@section('moduleName')
    @isset($moduleName)
        {{ $moduleName }}
    @endisset
@endsection

@section('pageTitle')
    @isset($moduleName)
        {{ $moduleName }}
    @endisset
@endsection


<body class="hold-transition sidebar-mini layout-fixed">
    {{--  <div id="preloaders" class="preloader"></div>  --}}
    <div class="wrapper">

        {{-- header --}}
        @include('layouts.partials.header')

        {{-- sidebar --}}
        @include('layouts.partials.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('pageTitle')</h1>

                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item active">{{ basename(url()->current()) }}</li> --}}
                                <li class="breadcrumb-item active">@yield('moduleName')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">


                @yield('content')


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.partials.footer')

        <!-- ./wrapper -->

        @include('layouts.partials.footerscript')

        @yield('script')
        <script>
            $(document).ready(function() {
                $("#preloaders").fadeOut(1000);

                @if (Session::has('message'))
                    Swal.fire(
                    '{{ $moduleName }}',
                    '{!! session('message') !!}',
                    'success'
                    )
                @endif
            });
        </script>
</body>

</html>
