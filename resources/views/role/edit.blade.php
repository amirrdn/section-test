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
                    {!! Form::model($role, ['files'=> 'true','method' => 'POST','route' => ['rolesupdate', $role->id], 'role' => 'form', 'data-toggle' => 'validator', 'novalidate' => 'true', 'name' => 'contentform', 'id' => 'demoForm', 'enctype' => 'multipart/form-data'])  !!}
                    @csrf
                        @include('role.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
