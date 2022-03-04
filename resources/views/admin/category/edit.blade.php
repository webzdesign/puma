@extends('layouts.app')
@section('moduleName', "$moduleName / Edit")

@section('content')
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit {{ $moduleName }}</h3>

                <div class="card-tools">

                </div>
            </div>

            <div class="card-body">

                <form id="form" method="post" action="{{ route($route . '.update', $category->id) }}"
                    class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="{{ $category->id }}" />
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3 col-sm-12">
                                <label for="name">Name<span class="requride_cls">*</span></label>
                                <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Name"
                                    value="{{ old('name', $category['name']) }}">
                                @if ($errors->has('name'))
                                    <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3 col-sm-12">
                            <label class="form-label">Code <span class="requride_cls">*</span></label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="Code"
                                value="{{ old('code', $category['code']) }}" />
                            @error('code')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @permission('activeinactive.category')

                        <div class="row g-3">
                            <div class="col-md-6 mb-3 col-sm-12">
                                <label class="form-label">Status <span class="requride_cls">*</span></label>
                                <div class="d-flex d-inline">
                                    <div class="form-check m-1">
                                        <input type="radio" class="form-check-input"
                                            {{ old('status', $category['status']) == 1 ? 'checked' : '' }} id="active"
                                            name="status" value="1" checked />
                                        <label for="active">Active</label>
                                    </div>

                                    <div class="form-check m-1">
                                        <input type="radio" class="form-check-input"
                                            {{ old('status', $category['status']) == 0 ? 'checked' : '' }} id="in_active"
                                            name="status" value="0" />
                                        <label for="in_active">In Active</label>
                                    </div>
                                </div>

                                @error('status')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            @if ($errors->has('status'))
                                <span class="requride_cls"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>
                    @endpermission

                    <center class="mt-4">
                        <button type="submit" class="btn btn-info">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default m-1" onclick="history.back()">Cancel</a>
                    </center>
                </form>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        jQuery(document).ready(function() {

            $('body').on('click', '.selectDeselect', function(e) {
                var selectVal = $(this).attr('value');
                if (selectVal == 'select') {
                    $(this).closest('.permission-listing').find(".permission").prop("checked", true);
                } else {
                    $(this).closest('.permission-listing').find(".permission").prop("checked", false);
                }
            });

            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                        remote: {
                            type: 'POST',
                            url: "{{ route('category.checkCategoryName') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                name: function() {
                                    return $("#name").val();
                                },
                                id: function() {
                                    return $("#id").val();
                                }
                            },
                        },
                    },
                    code: {
                        required: true,
                        noSpace: true,
                        remote: {
                            type: 'POST',
                            url: "{{ route('category.checkCategoryCode') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                code: function() {
                                    return $("#code").val();
                                },
                                id: function() {
                                    return $("#id").val();
                                }
                            },
                        },
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Role Name Is Required.",
                        remote: "Role Already Exist."
                    },
                    code: {
                        required: "Code Is Required.",
                        remote: "Category Code Already Exist."
                    },
                    status: {
                        required: "Status Is Required.",
                    },
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

        });
    </script>
@endsection
