@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('roles') }}">Roles</a></li>
        <li class="active">Edit Roles</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Roles</h3>
                    </div>
                    <form action="{{ route('users.roles_permission') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="box-body">
                                <div class="form-group">
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
                        <div class="col-md-12">
                            <div class="box-body">
                            @if (!empty($permissions))
                                <form action="{{ route('users.setRolePermission', request()->get('role')) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th>Can View</th>
                                                <th>Can Create</th>
                                                <th>Can Edit</th>
                                                <th>Can Delete</th>
                                                <th>Can Print</th>
                                                <th>Can Export</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($permissions as $key => $row)
                                            <tr>
                                                <td>{{ $row->module_names }}</td>
                                                 @foreach($permissions1->permis($row->id) as $cey => $bs)
                                                <td><input type="checkbox" name="permission[]" class="dot dot-success" value="{{ $bs }}"
                                                            {{ in_array($bs, $hasPermission) ? 'checked':'' }}> {{ $bs }}
                                                </td>
                                                @endforeach
                                                <td>
                                                    <a href="<?php echo url('/users/edit-permission/'.$row->id.'?role='.request()->get('role'));?>">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            </div>
                        <div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
