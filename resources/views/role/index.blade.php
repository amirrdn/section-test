@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Roles</h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Roles</li>
        </ol>
        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Roles List</h3>
                        <div class="form-group pull-right">
                            <a href="{{ route('rolescreate') }}" class="btn btn-sm btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="box-body">
                    <div class="flash-message">
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							  @if(Session::has('alert-' . $msg))

							  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							  @endif
							@endforeach
                          </div> 
                        <table class="table table-bordered" id="role-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#role-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('rolesdata') }}',
        columns: [
            {data: 'role_name', name: 'role_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
});
</script>
@endsection
