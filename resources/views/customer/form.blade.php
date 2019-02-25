<div class="row">
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group">
                <label for="name">First Name</label>
            {!! Form::text('first_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'First Name','class' => 'form-control')) !!}
           </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                {!! Form::text('last_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Last Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">DOB</label>
                {!! Form::text('dob', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'DOB','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="name">Gender</label>
                {!! Form::select('gender', array('1' => 'Male','2' => 'Female','0' => 'Gender'), $gender,array('required','class'=>'form-control')) !!}
            </div>                
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group">
                <label for="dob">Phone</label>
                {!! Form::number('phone_number', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Phone Number','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Email</label>
                {!! Form::text('email_address', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Company Name</label>
                {!! Form::text('company_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Company Name','class' => 'form-control')) !!}
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>