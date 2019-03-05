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
                    <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('users.set_role', $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {{ session('success') }}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $user->first_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>:</td>
                                            <td>
                                                @foreach ($roles as $row)
                                                <input type="radio" name="role" 
                                                    {{ $user->hasRole($row) ? 'checked':'' }}
                                                    value="{{ $row }}"> {{  $row }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm float-right">
                                        Set Role
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
