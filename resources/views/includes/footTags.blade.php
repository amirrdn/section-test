<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
  $(function () {

    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
  })
</script>
@if(Request::is('user-list'))

<script>
  $(document).ready(function() {
    var t = $('#users-table').DataTable( {
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
        processing: true,
        serverSide: true,
        ajax: '{!! route('get.datauser') !!}',
        columns: [
                    { data: 'images', name: 'images' },
                    { data: 'usernames', name: 'usernames' },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'role_id', name: 'role_id' },
                    { data: 'is_enebled', name: 'is_enebled' },
                    { data: 'email', name: 'email' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
        </script>
@endif
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>

@if(Request::is('') )

<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>



<!-- AdminLTE for demo purposes -->
<!-- Morris.js charts -->
<script src="{{ asset('admin/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>

<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>

@endif