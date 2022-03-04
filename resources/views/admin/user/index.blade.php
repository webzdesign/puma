@extends('layouts.app');
@section('content')

    
    
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
        <button type="button" class="btn btn-info filter-btn btn-sm" data-toggle="collapse" data-target="#filterBody"><i class="fa fa-filter"></i> Filters</button>
        </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <section class="content collapse show" id="filterBody">
        <div class="card">
            <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label><strong>Role</strong></label><br>
                        <select id='role_id' class="select2_single select2bs4 form-control">
                            <option value="">Select</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top:2.4%">
                        <button type="submit" class="btn btn-success searchData btn-sm">Apply Filters</button>
                        <button class="btn btn-danger searchClear btn-sm" data-toggle="collapse" data-target="#filterBody">Cancel</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

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

        $('.searchData').on('click', function(e) {
            e.preventDefault();
            datatable.draw();
        });

        $('.searchClear').on('click', function(e) {
            e.preventDefault();
            $('body').find('#role_id').val('').trigger('change');

            datatable.draw();
        });

    });
</script>

@endsection