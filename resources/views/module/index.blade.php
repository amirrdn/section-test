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
                        <form id="frm-example" method="POST">
                        {{ csrf_field() }}
                        <table class="table table-bordered" id="role-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>IsEnabled</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <button class="btn btn-danger btn-sm">Delete Checked</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
