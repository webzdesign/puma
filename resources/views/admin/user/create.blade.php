@extends('layouts.app');
@section('content')

    <div class="row">
        <div class="col-12 col-lg order-1 order-lg-0">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">Create {{ $moduleName }} </h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4 mb-3 col-sm-12">
                                <label class="form-label">Name <span class="requride_cls">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3 col-sm-12">
                                <label for="email">Email <span class="requride_cls">*</span></label>
                                <input type="text" name="email" class="form-control input-sm" id="email" placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="requride_cls">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4 mb-3 col-sm-12">
                                <label for="role_id">Role <span class="requride_cls">*</span></label>
                                <td>
                                    <select class="select2_single select2bs4 form-control" id="role_id" name="role_id">
                                        <option value="">Select</option>
                                    </select>
                                </td>
                                @error('role_id')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4 mb-3 col-sm-12">
                                <label class="form-label">Status <span class="requride_cls">*</span></label>
                                <div class="d-flex d-inline">
                                    <div class="form-check m-1">
                                        <input type="radio" class="form-check-input" id="active" name="is_active" value="1"
                                            checked />
                                        <label for="active">Active</label>
                                    </div>
                                    <div class="form-check m-1">
                                        <input type="radio" class="form-check-input" id="in_active" name="is_active"
                                            value="0" />
                                        <label for="in_active">In Active</label>
                                    </div>
                                </div>
                                @error('is_active')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <center class="mt-4">
                            <button class="btn btn-icon btn-icon-end btn-primary m-1" type="submit">Submit</button>
                            {{-- <input type="submit" class="btn btn-icon btn-icon-end btn-primary m-1" value="Submit" /> --}}
                            <a href="{{ url()->previous() }}" class="btn btn-default m-1" onclick="history.back()">Cancel</a>
                        </center>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('script')

<script>
    // $(document).ready(function() {
    //     $("#form").validate({
    //         rules: {
    //             name: {
    //                 required: true
    //             },
    //             email: {
    //                 required: true,
    //                 email: true
    //             },
    //             role_id: {
    //                 required: true
    //             },
    //             is_active: {
    //                 required: true
    //             }
    //         },
    //         messages: {
    //             name: {
    //                 required: "User Name Is Required."
    //             },
    //             email: {
    //                 required: "Email Is Required.",
    //                 email: "Invald Email."
    //             },
    //             role_id: {
    //                 required: "Role Is Required."
    //             },
    //             is_active: {
    //                 required: "Status Is Required."
    //             }
    //         },
    //         errorPlacement: function(error, element) {
    //             error.css('color', 'red').appendTo(element.parent("div"));
    //         },
    //         submitHandler: function(form) {
    //             form.submit();
    //             $(':input[type="submit"]').prop('disabled', true);
    //         }
    //     });
    // });
</script>

@endsection