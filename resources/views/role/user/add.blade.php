@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Roles
      </h1>
      <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('roles') }}">Roles</a></li>
        <li class="active">Create Roles</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Roles</h3>
                    </div>
                    <meta name="_token" content="{{ csrf_token() }}" /> 
						{{ method_field('post') }}
						{!! Form::open(['method' => 'POST','route' => ['permissionsave'],'role' => 'form', 'data-toggle' => 'validator', 'novalidate' => 'true', 'enctype' => 'multipart/form-data'])  !!}
						{{ csrf_field() }}
						@include('role.user.form_add')
						{!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
