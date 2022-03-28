@extends('layouts.app')
@section('content')
{{Config::set('subtitle',$moduleName)}}
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $moduleName }} Details</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        {{-- @permission('create.users') --}}
                        @if (auth()->user()->hasPermission('create.customerGroup'))
                            <a href="{{ route($route.'.create') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i>
                                New</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="datatable table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Added By</th>
                            <th>Status</th>
                            @if(auth()->user()->hasPermission('edit.customerGroup') || auth()->user()->hasPermission('activeinactive.customerGroup') || auth()->user()->hasPermission('delete.customerGroup') )
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var datatable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: {
                    "url": "{{ route('customerGroup.getCustomerGroupData') }}",
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
                        data: 'added_by'
                    },
                    {
                        data: 'status'
                    },
                    @if(auth()->user()->hasPermission('edit.customerGroup') || auth()->user()->hasPermission('activeinactive.customerGroup') )
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                @endif
                ],
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                Swal.fire({
                title: 'Are you sure want to Customer Group Delete ?',
                text: "As that can not undone by doing reverse.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {
                    window.location.href = linkURL;
                }
                });
            });

            $(document).on('click', '.activate', function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                Swal.fire({
                title: 'Are you sure want to Activate?',
                text: "As that can be undone by doing reverse.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    window.location.href = linkURL;
                }
                });
            });

            $(document).on('click', '.deactivate', function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                Swal.fire({
                title: 'Are you sure want to De-Activate?',
                text: "As that can be undone by doing reverse.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    window.location.href = linkURL;
                }
                });
            });

        });
    </script>
@endsection