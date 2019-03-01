<div class="row">
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group has-warning">
                <label for="inputWarning" class="text-danger">First Name</label>
                {!! Form::text('first_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'First Name','class' => 'form-control is-valid', 'id' => 'inputWarning')) !!}
                <span class="help-block">Username is taken</span>
           </div>
           <div class="form-group">
                <label for="last_name">Midle Name</label>
                {!! Form::text('middle_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Last Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="last_name" class="text-danger">Last Name</label>
                {!! Form::text('last_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Last Name','class' => 'form-control is-valid', 'id' => 'last_name')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Identity No#</label>
                {!! Form::text('indetity_no', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Identity No','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Mobile</label>
                {!! Form::text('mobile_phone', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Mobile','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Telephone</label>
                {!! Form::text('telephon', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Telephon','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                {!! Form::text('date_birth_day', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Date Of Birth','class' => 'form-control', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask' => 'data-mask', 'id' => 'datemask')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Quatification</label>
                {!! Form::text('quatification', null, array('placeholder' => 'Quatification','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Telephone</label>
                {!! Form::text('telephon', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Telephon','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Select Gender</label>
                <div class="form-group">
                    {!! Form::radio('gender', '1', ['class'=>'flat-red', 'id'=>'s admin']) !!}
                <label>Male
                    </label>
                </div>
                <div class="form-group">
                    {!! Form::radio('gender', '2', ['class'=>'flat-red', 'id'=>'f admin']) !!}
                <label>Female
                </label>
                </div>
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