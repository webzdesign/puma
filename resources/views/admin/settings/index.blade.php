@extends('layouts.app')



@section('content')
    <!-- Main content -->

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">{{ $moduleName }}</h2>

                        </div>
                        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data"
                            id="form">
                            @csrf()
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title" value="@if($setting){{$setting->name}}@endif">
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Site Logo:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                                <label class="custom-file-label" for="logo">Choose file</label>
                                            </div>
                                            <span
                                                class="error">{{ $errors->any() ? $errors->first('logo') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group"><br>
                                            @if ($setting)
                                                <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
                                                <img src="{{ asset(file_exists('storage/app/logo/' . $setting->logo) ? 'storage/app/logo/' . $setting->logo : 'public/assets/img/noimage.jpg') }}"
                                                    style="width:50px;height:50px;border-radius:10px;">
                                            @endif
                                            <img style="width:50px;height:50px;" id="newLogo">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Site Favicon:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="favicon" name="favicon">
                                                <label class="custom-file-label" for="favicon">Choose file</label>
                                            </div>
                                            <span
                                                class="error">{{ $errors->any() ? $errors->first('favicon') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group"><br>
                                            @if ($setting)
                                                <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
                                                <img src="{{ asset(file_exists('storage/app/favicon/' . $setting->favicon)? 'storage/app/favicon/' . $setting->favicon : 'public/assets/img/noimage.jpg') }}"
                                                    style="width:50px;height:50px;border-radius:10px;">
                                            @endif
                                            <img style="width:50px;height:50px;" id="newFavicon">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="form-group text-center">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
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
        $(document).ready(function() {
            @if (Session::has('message'))
                Swal.fire(
                '{{ $moduleName }}',
                '{!! session('message') !!}',
                'success'
                )
            @endif
            $('#newLogo').hide();
            $('#newFavicon').hide();

            function loadImg(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#newLogo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('select a file to see preview');
                    $('#newLogo').attr('src', '');
                }
            }

            function loadFavicon(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#newFavicon').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('select a file to see preview');
                    $('#newFavicon').attr('src', '');
                }
            }

            $("#logo").change(function() {
                loadImg(this);
                $('#newLogo').show();
            });

            $("#favicon").change(function() {
                loadFavicon(this);
                $('#newFavicon').show();
            });


            $(function() {
                $('#form').validate({
                    rules: {
                        title: {
                            required: true,
                        },
                        logo: {
                            extension: "jpg|jpeg|png|JPG|JPEG|PNG",
                        },
                        favicon: {
                            extension: "jpg|jpeg|png|ico|JPG|JPEG|PNG|ICO",
                        },
                    },
                    messages: {
                        title: {
                            required: "Please Provide Title.",
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        });
    </script>
@endsection
