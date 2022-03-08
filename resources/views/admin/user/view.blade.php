@extends('layouts.app');
@section('content')
{{Config::set('subtitle','View User')}}

<section class="content">
<div class="card">
    <div class="card-header">
        @if(Route::currentRouteName() == 'user.edit')
        <h3 class="card-title">Update Record</h3>
        @else
        <h3 class="card-title">View User</h3>
        @endif
        <div class="card-tools">

        </div>
    </div>
    <div class="card-body">
        <form id="form" method="POST" action="{{ route('user.update', $user['id']) }}"
            class="form-horizontal form-label-left" data-route="{{Route::currentRouteName()}}" autocomplete="off" enctype="multipart/form-data">
            @method('PUT')
            <input type="hidden" id="id" name="id" value="{{ $user['id'] }}" />
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name">Name<span class="requride_cls">*</span></label>
                        <input type="text" name="name" class="form-control input-sm" id="name"
                            placeholder="Employee Name" value="{{ old('name', $user['name']) }}">
                        @error('name')
                            <span class="error">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <label for="email">Email </label>
                        <input type="text" name="email" class="form-control input-sm" id="email" placeholder="Email"
                            value="{{ old('email', $user['email']) }}">
                        @error('email')
                            <span class="error">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="role_id">Role<span class="requride_cls">*</span></label>
                        @if(Route::currentRouteName() == 'user.edit')
                        <select class="select2_single" name="role_id" id="role_id" style="width:100%;">
                            <option value="">Select</option>
                            @foreach ($role as $key => $val)
                                <option {{ old('role_id', $user['role_id']) == $val->id ? 'selected' : '' }}
                                    value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                        @else
                            <input class="form-control " name="role_id" id="role_id"
                            value="{{ $user->role->name }}" disabled></td>
                        @endif
                        @if ($errors->has('role_id'))
                            <span class="requride_cls"><strong>{{ $errors->first('role_id') }}</strong></span>
                        @endif
                        @error('role_id')
                            <span class="error">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if (auth()->user()->haspermission('activeinactive.users'))
                        <div class="col-sm-6">
                            <label for="is_active">
                                Status <span class="requride_cls">*</span>
                            </label>
                            <div class="radio">
                                <label class="first-label-radio"><input type="radio" @if (old('is_active') != '') {{ old('is_active', $user['is_active']) == 1 ? 'checked' : '' }} @else checked @endif
                                        name="is_active" id="active" value="1"> Active</label>

                                <label><input type="radio" @if (old('is_active') != '') {{ old('is_active', $user['is_active']) == 0 ? 'checked' : '' }} @endif name="is_active" id="in_active"
                                        value="0"> In Active</label>
                            </div>
                            @if ($errors->has('is_active'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('is_active') }}</strong></span>
                            @endif
                        </div>
                    @endif
                </div>
                <center class="mt-4">
                    @if(Route::currentRouteName() == 'user.edit')
                    <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                    <a href="{{ url()->previous() }}" class="btn btn-default m-1"
                        onclick="history.back()">Cancel</a>
                </center>
            </div>
        </form>
    </div>
</section>

@endsection

@section('script')

<script>
    jQuery(document).ready(function() {

    if($("#form").attr('data-route') == 'user.view')
    {
        $("#form :input").prop("disabled", true);
    }


    $("#form").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
            },
            role_id: {
                required: true
            },
            is_active: {
                required: true
            }
        },
        messages: {
            name: {
                required: "User Name Is Required."
            },
            email: {
                required: "Email Is Required.",
                email: "Invald Email."
            },
            password: {
                required: "Password Is Required.",
                minlength: "Passwords Must Contain At Least Six Characters."
            },
            role_id: {
                required: "Role Is Required."
            },
            is_active: {
                required: "Status Is Required."
            }
        },
        errorPlacement: function(error, element) {
            error.css('color', 'red').appendTo(element.parent("div"));
        },
        submitHandler: function(form) {
            form.submit();
            $(':input[type="submit"]').prop('disabled', true);
        }
    });
});
</script>

@endsection