@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('user_list') }}">Users</a></li>
        <li class="active">Create User</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add User</h3>
                    </div>
                    <form action="{{ route('users.add_permission') }}" method="post">
                        @csrf
                                <div class="form-group">
                                    <label for="">Module</label>
                                    <select class="form-control" name="parent_id">
                                        @foreach($pages as $k)
                                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        Add New
                                    </button>
                                </div>
                            </form>


                            <form action="{{ route('users.roles_permission') }}" method="GET">
                                <div class="form-group">
                                    <label for="">Roles</label>
                                    <div class="input-group">
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $value)
                                                <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger">Check!</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            @if (!empty($permissions))
                                <form action="{{ route('users.setRolePermission', request()->get('role')) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_1" data-toggle="tab">Permissions</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Module</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        
                                                    @foreach ($permissions as $key => $row)
                                                    <tr>
                                                        <td>
                                                        {{ $row->name }}
                                                       </td>
                                                       @foreach($permissions1->permis($row->id) as $cey => $bs)
                                                        <td>
                                                        <input type="checkbox" 
                                                            name="permission[]" 
                                                            class="dot dot-success" 
                                                            value="{{ $bs }}"
                                                            {{ in_array($bs, $hasPermission) ? 'checked':'' }}
                                                            > {{ $bs }} <br>
                                                        </td>
                                                       @endforeach

                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-send"></i> Set Permission
                                        </button>
                                    </div>
                                </form>
                            @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
