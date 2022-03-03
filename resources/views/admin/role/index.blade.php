@extends('layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $moduleName }} Details</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        {{-- @permission('create.users') --}}
                        @if (auth()->user()->hasPermission('create.roles'))
                            <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i>
                                New</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="datatable table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>

            <!-- /.card-footer-->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
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

            @if (Session::has('failmessage'))
                Swal.fire(
                '{{ $moduleName }}',
                '{!! session('failmessage') !!}',
                'error'
                )
            @endif



            var datatable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: {
                    "url": "{{ route('role.getRoleData') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data": {
                        is_active: function() {
                            return $("#is_active").val();
                        },
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
@endsection
