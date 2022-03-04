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
                    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf()
                        <div class="row g-3">

                            <div class="col-md-4 mb-3 col-sm-12">
                                <label class="form-label">Name <span class="requride_cls">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3 col-sm-12">
                                <label for="category_id">Category <span class="requride_cls">*</span></label>
                                <td>
                                    <select class="select2_single select2bs4 form-control" id="category_id"
                                        name="category_id[]" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @error('category_id')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @permission('activeinactive.roles')
                                <div class="col-md-4 mb-3 col-sm-12">
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
                            @endpermission
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8 mb-3 col-sm-12">
                                    <label for="description">Description </label></label>
                                    <textarea id="description" name="description" class="form-control"
                                        placeholder="Ex : User Role" style="resize:none;"
                                        rows="3">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3 col-sm-12">
                            <label class="form-label pl-1">Permissions :</label>
                            <div class="col-lg-12 permission-card">
                                @php
                                    $cnt = 1;
                                    $cn = 1;
                                @endphp
                                @foreach ($permissions as $k => $permission)
                                    @if ($k == 'Role')
                                        @continue
                                    @else
                                        @if ($cnt % 3 == 1)
                                        <div class="row">
                                        @endif
                                            <div class="col-lg-4 col-sm-4 mb-3 permission-listing">
                                                <div class="card">
                                                    <div class="card-header permission-card-header text-center">
                                                        <h4>{{ $k }}</h4>


                                                        <div class="text-center pl-2 pr-2">
                                                            <a class="float-left permission-card-title selectDeselect"
                                                                style="cursor: pointer;color:rgb(24, 84, 213);"
                                                                value="select">Select
                                                                All</a>
                                                            <a class="float-right permission-card-title selectDeselect"
                                                                style="cursor: pointer;color:rgb(24, 84, 213);"
                                                                value="deselect">Deselect
                                                                All</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ml-3 mr-3">

                                                        @foreach ($permission as $key => $val)
                                                            <div class="custom-control custom-checkbox p-2">
                                                                <input class="custom-control-input permission form-check-input"
                                                                    type="checkbox" id="customCheckbox{{ $cn }}"
                                                                    name="permission[]" value="{{ $val->id }}">
                                                                <label for="customCheckbox{{ $cn }}"
                                                                    class="custom-control-label permision-label cursor-pointer">&nbsp;{{ $val->name }}</label>
                                                            </div>
                                                            @php $cn++; @endphp
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @if ($cnt % 3 == 0)
                                        </div>
                                        <hr class="form-part">
                                        @endif
                                     @php $cnt++; @endphp
                                    @endif
                                @endforeach
                            </div>
                        <div class="row">
                            <div id="messageBox" class="requride_cls"></div>
                        </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <button class="btn btn-icon btn-icon-end btn-primary m-1" type="submit">
                    Submit
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-default m-1" onclick="history.back()">Cancel</a>
            </div>

        </div>


        </form>
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
                            url: "{{ route('role.checkRole') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                name: function() {
                                    return $("#name").val();
                                },
                            },
                        },
                    },
                    description: {
                        required: true,
                    },
                    "category_id[]": {
                        required: true,
                    },
                    "permission[]": {
                        required: true,
                        minlength: 1
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
                    "category_id[]": {
                        required: "Please select at least one Category.",
                    },
                    description: {
                        required: "Description Is Required.",
                    },
                    status: {
                        required: "Status Is Required.",
                    },
                    "permission[]": "Please select at least one types of permission.",
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
                    if(element.type != 'checkbox'){
                        $(element).addClass('is-invalid');
                    }
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


        })
    </script>
@endsection
