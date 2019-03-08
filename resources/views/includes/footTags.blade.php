<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>-->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!--
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
//  $(function () {
   $(document).ready(function() {
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
  })

</script>
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
-->
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
  $(document).ready(function(){
	
	$('input[type=password]').keyup(function() {
		var pswd = $(this).val();
		
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
      $('#submit').prop('disabled',false);
		} else {
			$('#length').removeClass('invalid').addClass('valid');
      $('#submit').prop('disabled',true);
		}
		
		//validate letter
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
      $('#submit').prop('disabled',true);
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
      $('#submit').prop('disabled',false);
		}

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
      $('#submit').prop('disabled',true);
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
      $('#submit').prop('disabled',false);
		}

		//validate number
		if ( pswd.match(/\d/) ) { 
			$('#number').removeClass('invalid').addClass('valid');
      $('#submit').prop('disabled',true);
		} else {
			$('#number').removeClass('valid').addClass('invalid');
      $('#submit').prop('disabled',false);
		}
		
		//validate space
		if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
			$('#space').removeClass('invalid').addClass('valid');
      $('#submit').prop('disabled',true);
		} else {
			$('#space').removeClass('valid').addClass('invalid');
      $('#submit').prop('disalbed',false);
		}
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
    $('#submit').prop('disabled',false);
	});


	
});
</script>

@if(Request::is('user-list'))


@endif

<!--
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>


<!-- Bootstrap WYSIHTML5 
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
-->


<!-- AdminLTE for demo purposes -->
<!-- Morris.js charts -->
<!--
<script src="{{ asset('admin/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline 
<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart 
<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!--
  <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
  -->

  @stack('scripts')