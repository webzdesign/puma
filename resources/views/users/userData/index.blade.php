@extends('layouts.app');
@section('content')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $module }} Details</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        @if (auth()->user()->hasPermission('create.users'))
                            <a href="" class="btn btn-primary btn-sm"><i
                                class="fa fa-plus"></i>
                            New</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body  table-responsive">
                <table class="datatable  table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Mobile No.</th>
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
        
    });
</script>

@endsection