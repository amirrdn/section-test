@extends('layouts.app')

@section('content')
<style>
.dot-danger {
    background-color: red;
}
.dot {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    position: center;
}
.dot-success {
    background-color: green;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
      ROLE PERMISSIONS oke
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('roles') }}">Roles Permissions List</a></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Roles Permissions List</h3>
                    </div>
                    <form action="{{ route('users.roles_permission') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="box-body">
                                <div class="form-group">
                                    <a href="{{route('permissionadd') }}" class="btn btn-sm btn-primary pull-right">Create</a>
                                </div>
                                <div class="form-group" style="clear:both;margin-top: 38px;">
                                    <label for="" class="col-md-4">Roles</label>
                                    <div class="input-group">
                                        <select name="role" class="col-md-8 form-control">
                                            @foreach ($roles as $value)
                                                <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger">Check!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="col-md-12">
                            <div class="box-body">
                            <div class="flash-message">
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							  @if(Session::has('alert-' . $msg))

							  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							  @endif
							@endforeach
                          </div> 
                            @if (!empty($permissions))
                            <form method="post" action="{{ route('setroles') }}">
                                    @csrf
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th class="text-center">Can View</th>
                                                <th class="text-center">Can Create</th>
                                                <th class="text-center">Can Edit</th>
                                                <th class="text-center">Can Delete</th>
                                                <th class="text-center">Can Print</th>
                                                <th class="text-center">Can Export</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($permissions as $key => $row)
                                            <tr>
                                                <td>{{ $row->module_names }}</td>
                                                 @foreach($permissions1->permis($row->id) as $cey => $bs)
                                                <td>
                                                <?php 
                                                    if(in_array($bs, $hasPermission) ? 'checked':''){
                                                        $is_enebled = 'dot dot-success col-md-offset-5';
                                                    }else{
                                                        $is_enebled = 'dot dot-danger col-md-offset-5';
                                                    }
                                                ?>
                                                    <input type="checkbox" id="optionsRadios1" name="permission[]" class="{{ $is_enebled }}" value="{{ $bs }}"
                                                            {{ in_array($bs, $hasPermission) ? 'checked':'' }}> {{ $bs }}
                                                </td>
                                                @endforeach
                                                <td>
                                                    <a class="btn btn-xs btn-success col-md-offset-5" href="<?php echo url('/users/edit-permission/'.$row->id.'?role='.request()->get('role'));?>">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                    <div class="pull-right">
                                    
                                    <input type="hidden" name="role" value="<?php echo request()->get('role'); ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-send"></i> Set Permission
                                        </button>
                                    </form>
                                    </div>
                            </div>
                        <div>
                            @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
