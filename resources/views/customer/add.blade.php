@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Form Insert Customer
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('indexcust') }}">Data Customer</a></li>
        <li class="active">Insert Customer</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Insert Customer</h3>
                    </div>
                    <meta name="_token" content="{{ csrf_token() }}" /> 
						{{ method_field('post') }}
						{!! Form::open(['method' => 'POST','route' => ['savecust']])  !!}
						{{ csrf_field() }}
						@include('customer.form')
						{!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
