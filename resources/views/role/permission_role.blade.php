@extends('layouts.app')

@section('content')

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
                               <!-- <div class="form-group" style="clear:both;margin-top: 38px;">
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
                                </div> -->
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
                            <!--
                                <div class="row">
                                <div class="col-md-1">
                                    -->
                                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                                    @foreach($roles_name as $key => $r)
                                        <li class=<?php if($key==0){echo "active";} ?>><a href="{{ url('/users/role-permission?role='.$r->name) }}" data-target="#{{$r->id}}" class="media_node active span" id="contacts_tab" data-toggle="tabajax" rel="tooltip"> {{$r->name}} </a></li>
                                    @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach($roles_name as $keys => $rs)
                                        <form class="tab-pane fade <?php if($keys==0){echo "active";} ?> in " id="{{$rs->id}}">
                                            <div id="op">
                                                @include('role.ajax_data')
                                            </div>
                                        </form>
                                        @endforeach
                                        </div>
                            
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@push('scripts')
<script>
$(function() {
    var url = window.location.href+'?role=Admin';
    $('#myTab li a[href="'+url+'"]').tab('show');

    $('#myTab li').removeClass('active open');
    var url = window.location.href+'?role=Admin';
    $('#op').load(url);
    url && $('ul.nav a[href="' + url + '"]').tab('show');
    
    $('[data-toggle="tabajax"]').click(function(e) {
        var $this = $(this),
            loadurl = $this.attr('href'),
            targ = $this.attr('data-target');

        $.get(loadurl, function(data) {
            $(targ).html("<form>"+data+"</form>");
        });

        $this.tab('show');
        return false;
    });
});
$('[data-toggle="tabajax"]').click(function(e) {
    var $this = $(this),
    targ = $this.attr('data-target');
    $(targ).on('submit',function(e){
    e.preventDefault();
      var formData = $(targ).serialize();
      swal({
        title: "Are you sure?",
        //text: "You will not be able to recover this imaginary file!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, update it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: '{{ route("setroles") }}',
            data: formData,
            type: 'post',
            dataType: "html",
            success: function () {
                swal("Done!", "It was succesfully update permissions!", "success");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error update!", "Please try again", "error");
            }
        });
    });;
});

});

</script>
@endpush