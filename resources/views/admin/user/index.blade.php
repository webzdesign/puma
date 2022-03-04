@extends('layouts.app')
@section('content')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $moduleName }} Details</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        @if (auth()->user()->hasPermission('create.users'))
                            <a href="{{route('user.create')}}" class="btn btn-primary btn-sm"><i
                                class="fa fa-plus"></i>
                            New</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body  table-responsive">
                <div class="form-group">
                    <label><strong>Role :</strong></label>
                    <select id='role_id' class="select2_single select2bs4 form-control" style="width: 20%;">
                        <option value="">Select</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <table class="datatable  table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Role </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </section>

@endsection


@section('script')

<script>
    $(document).ready(function(){

        @if (Session::has('message'))
            Swal.fire(
            '{{ $moduleName }}',
            '{!! session('message') !!}',
            'success'
            )
        @endif

        @if (Session::has('failmessage'))
            Swal.fire(
            '{{ $moduleName }}',
            '{!! session('failmessage') !!}',
            'error'
            )
        @endif

        var datatable = $('.datatable').DataTable({
            processing:true,
            serverSide:true,
            pageLength:50,
            ajax: {
                "url":"{{ route('getUserData') }}",
                "dataType":"json",
                "type":"GET",
                "data":{
                    is_active: function(){
                        return $("#is_active").val();
                    },
                    role_id: function(){
                        return $("#role_id").val();
                    }
                }
            },
            columns:[{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role.name'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        $('#role_id').change(function(){
            datatable.draw();
        });
    });
</script>

@endsection