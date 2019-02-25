@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
       Data Customer
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Customer</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Customer</h3>
                    </div>
                    <div class="flash-message">
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							  @if(Session::has('alert-' . $msg))

							  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							  @endif
							@endforeach
                          </div> 
                    <div class="box-body">
                        <div class="form-group">
                            <a target="_blank" href="{{route('printcust') }}" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-print"></i></a>
                        </div>
                    </div>
                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cust as $b)
                                <tr>
                                    <td>{{ $b->first_name }} {{ $b->last_name }}</td>
                                    <td>{{ $b->dob }}</td>
                                    <td>@if($b->gender == 1) Man @else Women @endif</td>
                                    <td>{{ $b->phone_number }}</td>
                                    <td>{{ $b->email_address }}</td>
                                    <td>{{ $b->company_name }}</td>
                                    <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">Action</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('editcust', $b->id) }}">Edit</a></li>
                                            <li><a href="{{ route('deletecust', $b->id) }}"  onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Delete</a></li>
                                        </ul>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $cust->appends(\Request::except('_token'))->render() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
