@extends('layouts.app')
@section('moduleName', "$moduleName / Edit")

@section('content')
{{Config::set('subtitle','Edit '.$moduleName)}}
<section class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit {{ $moduleName }}</h3>

            <div class="card-tools">

            </div>
        </div>

        <div class="card-body">

            <form id="form" method="post" action="{{ route($route . '.update', $customerGroup->id) }}"
                class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" id="id" name="id" value="{{ $customerGroup->id }}" />
                @csrf

                <div class="form-group">
                    <div class="row g-3">
                        <div class="col-md-4 mb-3 col-sm-12">
                            <label for="name">Name<span class="requride_cls">*</span></label>
                            <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Name"
                                value="{{ old('name', $customerGroup['name']) }}">
                            @if ($errors->has('name'))
                                <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        @permission('activeinactive.customerGroup')
                        <div class="col-md-4 mb-3 col-sm-12">
                            <label class="form-label">Status <span class="requride_cls">*</span></label>
                            <div class="d-flex d-inline">
                                <div class="form-check m-1">
                                    <input type="radio" class="form-check-input"
                                        {{ old('status', $customerGroup['status']) == 1 ? 'checked' : '' }} id="active"
                                        name="status" value="1" checked />
                                    <label for="active">Active</label>
                                </div>

                                <div class="form-check m-1">
                                    <input type="radio" class="form-check-input"
                                        {{ old('status', $customerGroup['status']) == 0 ? 'checked' : '' }} id="in_active"
                                        name="status" value="0" />
                                    <label for="in_active">In Active</label>
                                </div>
                            </div>

                            @error('status')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @if ($errors->has('status'))
                                <span class="requride_cls"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>
                        @endpermission
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-info">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default m-1" onclick="history.back()">Cancel</a>
                </div>
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
                            url: "{{ route('customerGroup.checkCustomerGroupName') }}",
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
                        required: "Customer Group Name Is Required.",
                        remote: "Customer Group Already Exist."
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