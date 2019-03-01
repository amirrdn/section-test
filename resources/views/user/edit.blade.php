@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Form Edit Customer
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('indexcust') }}">Data Customer</a></li>
        <li class="active">Edit Customer</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Edit</h3>
                    </div>
                    {!! Form::model($user, ['method' => 'POST','route' => ['updatecust', $user->id]])  !!}
                    @csrf
					    @include('user.form')
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
