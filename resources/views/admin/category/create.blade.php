@extends('layouts.app')

@section('moduleName', "$moduleName / Create")

@section('content')

    <div class="row">
        <div class="col-12 col-lg order-1 order-lg-0">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">{{ $moduleName }} Create</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="{{ route($route . '.store') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf()
                        <div class="row g-3">
                            <div class="col-md-6 mb-3 col-sm-12">
                                <label class="form-label">Name <span class="requride_cls">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 mb-3 col-sm-12">
                                <label class="form-label">Code <span class="requride_cls">*</span></label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Code"
                                    value="{{ old('code') }}" />
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
                                            <input type="radio" class="form-check-input" id="active" name="status" value="1"
                                                checked />
                                            <label for="active">Active</label>
                                        </div>

                                        <div class="form-check m-1">
                                            <input type="radio" class="form-check-input" id="in_active" name="status"
                                                value="0" />
                                            <label for="in_active">In Active</label>
                                        </div>
                                    </div>

                                    @error('status')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endpermission

                        <div class="card-footer d-flex justify-content-center">
                            <button class="btn btn-icon btn-icon-end btn-primary m-1" type="submit">
                                Submit
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-default m-1"
                                onclick="history.back()">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

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
                            },
                        },
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Category Name Is Required.",
                        remote: "Category Name Already Exist."

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
                    if (element.attr("name") == "permission[]") {
                        error.appendTo("#messageBox");
                    } else {
                        {{-- error.insertAfter(element) --}}
                        error.css('color', 'red').appendTo(element.parent("div"));
                    }
                },
                highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


        })
    </script>
@endsection
