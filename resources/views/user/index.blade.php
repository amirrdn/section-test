@extends('layouts.app')
@section('content')
<style>
.modal-body label{
    font-size: 12px;
    padding-left: 0px;
}
input[type="text"], input[type="email"] {
        font-size: 12px;
        color: #010100;
        width: 100%;
    }
    div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    margin-top: -43px;
}
.xlp{
    margin-right: -51px;
    margin-bottom: -86px;
}
.frm-example{
    margin-top: -100px;
}
.xl-print{
    float: left;
    margin-bottom: 8px;
    margin-left: 116px;
    margin-right: -73px;
}
.xl-input{
    margin-bottom: -10px;
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                        <div class="col-md-8">
                        <h3 class="box-title">Users List</h3>
                        </div>
                        <div class="col-md-2 form-group xl-print">
                        <form action="{{ route('pdfuser') }}" method="get" style="margin-right: 36px" class="col-sm-1">
                                <input type="text" name="name" class="text_div form-controll" style="display:none">
                                <input type="text" name="role_id" class="role_id form-controll" style="display:none">
                                <input type="text" name="email" class="email form-controll" style="display:none">
                                <input type="text" name="status" class="status form-controll" style="display:none">
                                <input type="text" name="user_name" class="user_name form-controll" style="display:none">
                                <input type="text" name="user_name" class="user_name form-controll" style="display:none">
                                <button formtarget="_blank" type="submit" class="btn btn-primary btn-sm">PDF</button>
                            </form>
                            <form action="{{ route('userpirnt') }}" method="get">
                                <input type="text" name="name" class="text_div form-controll" style="display:none">
                                <input type="text" name="role_id" class="role_id form-controll" style="display:none">
                                <input type="text" name="email" class="email form-controll" style="display:none">
                                <input type="text" name="status" class="status form-controll" style="display:none">
                                <input type="text" name="user_name" class="user_name form-controll" style="display:none">
                                <button formtarget="_blank" type="submit" class="btn btn-primary btn-sm">Print</button>
                            </form>
                        </div>
                        <div class="col-md-2 form-group pull-right xlp">
                            @if (auth()->user('Admin')->can('user create'))
                            <a href="{{ route('user_create') }}" class="btn btn-sm btn-primary">Create</a>
                            @endif
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-fw fa-filter"></i></button>
                        </div>
                        </div>
                    </div>
                    <div class="box-body">
                    <div class="delete"></div>
                    <div class="flash-message">
                   
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							  @if(Session::has('alert-' . $msg))

							  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							  @endif
							@endforeach
                          </div> 
                            
                        <div class="form-group xl-input">
                            <div class="row">
                            <div class="col-md-6">
                            
                            </div>
                            <div class="col-md-4"></div>
                                <div class="col-md-2 form-group ">
                                    <input name="searchingfield" type="text" class="form-control" id="searchingfield">
                                </div>
                            </div>
                        </div>
                        <!--
                            <iframe src="{{ route('userpirnt')}}" name="frame1" style="display:none"></iframe>
                            <button type="button" class="btn btn-default btn-sm" onclick="frames['frame1'].print()">Print</button>
                        -->
                        <form id="frm-example" method="POST">
                        {{ csrf_field() }}
                        <table class="table table-bordered display select"cellspacing="0" width="100%" id="users-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                    <th>No.</th>
                                    <th style="width: 16%;">Image</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <button class="btn btn-danger btn-sm">Delete Checked</button>
                        </form>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" id="search-form" class="form-inline" role="form">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Filter</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name" class="col-md-12">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name">
                                                </div>
                                                <br />
                                                <div class="form-group">
                                                    <label for="name" class="col-md-12">Role <span class="dengertext">*</span></label>
                                                    {!! Form::select('roleses',$role_id,null,['id' => 'role_id','class' => 'form-control', 'placeholder' => 'Please Select']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="email" class="col-md-12">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email">
                                                </div>
                                                <br />
                                                <div class="form-group">
                                                    <label for="name" class="col-md-12">Status</label>
                                                    <select name="status" class="form-control" id="statusd">
                                                        <option value="0">Please Select</option>
                                                        <option value="yes">Enebled</option>
                                                        <option value="no">Disebled</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="email" class="col-md-12">Username</label>
                                                    <input type="text" class="form-control" name="user_name" id="user_name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">Close</button>
                                        <button type="submit" id="search-form" class="btn btn-primary">Search</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        <!-- /.modal-dialog -->
                        </div>
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
    var t = $('#users-table').DataTable( {
      'searching'   : false,
      "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 1
        } ],
        "order": [[ 1, 'asc' ]],
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('get.datauser') !!}',
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.email = $('input[name=email]').val();
                d.user_name = $('input[name=user_name]').val();
                d.roleses = $('select[name=roleses]').val();
                d.statusd = $('select[name=status]').val();
                d.searchingfield = $('input[name=searchingfield]').val();
            }
        },
        columns: [
                    //{ data: 'id', name: 'users.id' },
                    { data: 'checkbox', name: 'checkbox',searchable: true, sortable : false },
                    { data: 'user_image', name: 'posts.user_image' },
                    { data: 'user_image', name: 'posts.user_image' },
                    { data: 'first_name', name: 'users.first_name' },
                    { data: 'user_name', name: 'users.user_name' },
                    { data: 'role', name: 'role' },
                    { data: 'is_enebled', name: 'users.is_enebled' },
                    { data: 'email', name: 'users.email' },
                    { data: 'last_login_at', name: 'users.last_login_at' },
                    {data: 'action', name: 'action'}
                    

                ],
                
    } );
    
    t.on('order.dt search.dt', function () {
        t.column(1, {search:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
    $('#search-form').on('submit',function(e) {
        
        var name      = $('#name').val();
        var email     = $('#email').val();
        var username  = $('#user_name').val();

        $('input[type=text].text_div').val(name);
        
        $('input[type=text].email').val(email);
        $('input[type=text].user_name').val(username);

        $('#modal-default').modal('toggle');
       
        t.draw();
        e.preventDefault();
       $('input[name=email]').val("");
       $('input[name=user_name]').val("");
       $('select[name=roleses]').prop('selectedIndex',0);
        $('input[name=name]').val(" ");
       $('select[name=status]').prop('selectedIndex',0);
    });
    $("#role_id").on('change', function () {
      $('input[type=text].role_id').val($(this).val());
    });
    $("#statusd").on('change', function () {
      $('input[type=text].status').val($(this).val());
    });

    $('#searchingfield').on('keyup',function(e){
      var input = $(this);
      var name      = $('#searchingfield').val();
      if(input.val().length > 1){
        $('input[type=text].text_div').val(name);
        t.draw();
        e.preventDefault();
      }else{
        $('input[type=text].text_div').val(name);
        t.draw();
        e.preventDefault();
      }
      //input.next("span").text(input.val().length + " chars");
    });

    $('#example-select-all').click(function (e){
      // Get all rows with search applied
      var rows = $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   $('#frm-example').on('submit', function(e){
      var form = this;
      var $button = $(this);
    
      // Iterate over all checkboxes in the table
      $(this).closest('table').find('td input:checkbox').prop('checked', this.checked).each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         } 
      });

      $('#example-console').text($(form).serialize()); 
      e.preventDefault();
      var formData = $('#frm-example').serialize();
      $.ajax({
        url: '{{ route("delete_users") }}',
        data: formData,
        type: 'post',
        dataType: 'json',
        success: function(data) {
          $('#users-table').DataTable().ajax.reload()
          //$('div.flash-message').html(data);
        }
    });
   });
   
    
} );
</script>
@endpush
