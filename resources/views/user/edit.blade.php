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
        <li class="active">Edit Users</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Update Users</h3>
                        </div>
                        <div class="col-md-4">
                            <h3 class="box-title">Last Login : {{ $user->last_login_at }}</h3>
                        </div>
                        <div class="col-md-4">
                            <h3 class="box-title">Last Login IP address : {{ $user->last_login_ip }}</h3>
                        </div>
                    </div>
                    {!! Form::model($user, ['files'=> 'true','method' => 'POST','route' => ['update_user', $user->id], 'role' => 'form', 'data-toggle' => 'validator', 'novalidate' => 'true', 'name' => 'contentform', 'id' => 'demoForm', 'enctype' => 'multipart/form-data'])  !!}
                    @csrf
                    {!! Form::hidden('user_image', null, array('autofocus' => 'autofocus','placeholder' => 'Telephon','class' => 'form-control')) !!}
                    <input type="hidden" name="password" value="<?php echo $user->password;?>">
                        @include('user.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
