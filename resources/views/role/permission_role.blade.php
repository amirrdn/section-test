@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
<?php
    use Spatie\Permission\Models\Permission;
?>
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
      ROLE PERMISSIONS
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
                    <form id="frm-example" method="GET">
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
                                
                                @include('role.ajax_data')
                            @else
                            <!--
                                <div class="row">
                                <div class="col-md-1">
                                <table class="table">
                                        <tr>
                                            <th>Module</th>
                                        </tr>
                                        <tr>
                                            <th>-</th>
                                        </tr>
                                       @foreach($module_td as $m)
                                       <tr>
                                        <td>{{$m->module_names}}</td>
                                        </tr>
                                        @endforeach
                                </table>
                                </div>
                                
                                <div class="col-md-11">
                                
                                    <ul class="nav nav-tabs" id="myTabs">
                                    @foreach($roles_name as $r)
                                    <?php
                                        $name_role     = str_replace(' ', '+', $r->name);
                                    ?>
                                        <li><a href="#{{$r->id}}" data-url="{{ url('/users/role-permission?role='.$name_role) }}">{{$r->name}}</a></li>
                                    @endforeach
                                    </ul>
                                    
                                    <div class="tab-content">
                                    @foreach($roles_name as $rs)
                                        <div class="tab-pane" id="{{$rs->id}}">
                                            
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                    -->
                        @endif
                            
                </div>
            </div>
        </div>
    </section>
</div>
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>

$(document).ready( function(){
    $('#myTabs a').click(function (e) {
	e.preventDefault();
  
	var url = $(this).attr("data-url");
  	var href = this.hash;
  	var pane = $(this);
	// ajax load from data-url
	$(href).load(url,function(result){      
	    pane.tab('show').val(result);
	});
});

});

</script>
@endsection
