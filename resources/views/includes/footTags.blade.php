<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


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

<script>
  $(document).ready(function() {
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
                d.roles = $('select[name=roles]').val();
                d.statusd = $('select[name=status]').val();
                d.searchingfield = $('input[name=searchingfield]').val();
            }
        },
        /*
        'columnDefs': [{
         'targets': 0,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
         }
      }],
      'order': [[1, 'asc']],
      */
      
        columns: [
                    //{ data: 'id', name: 'users.id' },
                    { data: 'checkbox', name: 'checkbox',searchable: true, sortable : false },
                    { data: 'user_image', name: 'posts.user_image' },
                    { data: 'user_image', name: 'posts.user_image' },
                    { data: 'first_name', name: 'users.first_name' },
                    { data: 'user_name', name: 'users.user_name' },
                    { data: 'role_name', name: 'users.role_name' },
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
      $('#search-form').submit(function(e) {
        
        var name      = $('#name').val();
        var email     = $('#email').val();
        var username  = $('#user_name').val();

        $('input[type=text].text_div').val(name);
        
        $('input[type=text].email').val(email);
        $('input[type=text].user_name').val(username);


        $('#modal-default').modal('toggle');
        t.draw();
        e.preventDefault();
        return false;
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