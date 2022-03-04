@extends('layouts.app')
@section('moduleName', "$moduleName / Edit")

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit {{ $moduleName }}</h3>

                <div class="card-tools">

                </div>
            </div>

            <div class="card-body">

                <form id="form" method="post" action="{{ route('role.update', $role->id) }}"
                    class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="{{ $role->id }}" />
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 mb-3 col-sm-12">
                                <label for="name">Name<span class="requride_cls">*</span></label>
                                <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Name"
                                    value="{{ old('name', $role['name']) }}">
                                @if ($errors->has('name'))
                                    <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-md-4 mb-3 col-sm-12">
                                <label for="category_id">Category <span class="requride_cls">*</span></label>
                                <td>
                                    <select class="select2_single select2bs4 form-control" id="category_id"
                                        name="category_id[]" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"  {{ in_array($category->id,$categoryId) ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                    <label for="status">Status<span class="requride_cls">*</span></label>
                                    <div class="radio">
                                        <label class="first-label-radio"><input type="radio"
                                                {{ old('status', $role['status']) == 1 ? 'checked' : '' }} name="status"
                                                id="active" value="1"> Active</label>
                                        <label><input type="radio" {{ old('status', $role['status']) == 0 ? 'checked' : '' }}
                                                name="status" id="in_active" value="0"> In Active</label>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="requride_cls"><strong>{{ $errors->first('status') }}</strong></span>
                                    @endif
                                </div>

                            @endpermission
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3 col-sm-12">

                                <label for="description">
                                    Description
                                </label>
                                <textarea id="description" name="description" class="form-control"
                                    placeholder="Enter Description" style="resize:none;"
                                    rows="3">{{ old('description', $role['description']) }}</textarea>
                                @if ($errors->has('description'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name p-1">Permissions :</label>
                        <div class="col-lg-12 permission-card">
                            @php
                                $cnt = 1;
                                $cn = 1;
                            @endphp
                            @foreach ($permissions as $k => $permission)
                                @if ($cnt % 3 == 1)
                                    <div class="row">
                                @endif
                                <div class="col-lg-4 col-sm-4 mb-3 permission-listing">
                                    <div class="card">
                                        <div class="card-header permission-card-header text-center">
                                            <h4>{{ $k }}</h4>


                                            <div class="text-center pl-2 pr-2">
                                                <a class="float-left permission-card-title selectDeselect"
                                                    style="cursor: pointer;color:rgb(24, 84, 213);" value="select">Select
                                                    All</a>
                                                <a class="float-right permission-card-title selectDeselect"
                                                    style="cursor: pointer;color:rgb(24, 84, 213);"
                                                    value="deselect">Deselect
                                                    All</a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card-body ml-3 mr-3">
                                            @foreach ($permission as $key => $val)
                                                @if (($val->name == 'Delete Technology' || $val->slug == 'destroy.technology') && $role->id == 2)
                                                @else
                                                    <div class="custom-control custom-checkbox p-2">
                                                        <input class="custom-control-input permission" type="checkbox"
                                                            id="customCheckbox{{ $cn }}" name="permission[]"
                                                            @if (in_array($val->id, $existPermissions)) checked @endif
                                                            value="{{ $val->id }}">

                                                        <label for="customCheckbox{{ $cn }}"
                                                            class="custom-control-label permision-label">{{ $val->name }}</label>
                                                    </div>
                                                    @php $cn++; @endphp
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @if ($cnt % 3 == 0)
                        </div>
                        <hr class="form-part">
                        @endif
                        @php $cnt++; @endphp
                        @endforeach
                    </div>
                    {{-- </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer"> --}}
                    <center class="mt-4">
                        <button type="submit" class="btn btn-info">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default m-1" onclick="history.back()">Cancel</a>
            </div>
        </div>
        </form>
        <!-- /.card-footer-->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->


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
                            url: "{{ route('role.checkRole') }}",
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
                    status: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Role Name Is Required.",
                        remote: "Role Already Exist."
                    },
                    status: {
                        required: "Status Is Required.",
                    },
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
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

        });
    </script>
@endsection
