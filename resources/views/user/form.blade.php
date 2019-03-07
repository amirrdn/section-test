<div class="row">
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group">
                <label for="inputWarning">First Name<span class="dengertext">*</span></label>
                {!! Form::text('first_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Enter First Name','class' => 'form-control', 'data-error' => 'This first name field is required')) !!}
                <div class="help-block with-errors"></div>
           </div>
           <div class="form-group">
                <label for="last_name">Midle Name</label>
                {!! Form::text('middle_name', null, array('autofocus' => 'autofocus','placeholder' => 'Enter Middle Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="last_name" class="text-danger">Last Name<span class="dengertext">*</span></label>
                {!! Form::text('last_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Enter Last Name','class' => 'form-control is-valid', 'id' => 'last_name')) !!}
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="dob">Identity No#</label>
                {!! Form::text('indetity_no', null, array('autofocus' => 'autofocus','placeholder' => 'Enter Identity No','class' => 'form-control', 'data-error' => 'This last name field is required')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Mobile</label>
                {!! Form::text('mobile_phone', null, array('autofocus' => 'autofocus','placeholder' => 'Enter Mobile','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Telephone</label>
                {!! Form::text('telephon', null, array('autofocus' => 'autofocus','placeholder' => 'Enter Telephon','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                {!! Form::text('date_birth_day', null, array('autofocus' => 'autofocus','placeholder' => 'Enter Date Of Birth','class' => 'form-control', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask' => 'data-mask', 'id' => 'datemask')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Quatification</label>
                {!! Form::text('quatification', null, array('placeholder' => 'Enter Quatification','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="dob">Select Gender</label>
                <div class="radio">
                <label>
                    {!! Form::radio('gender', '1', ['class'=>'flat-red', 'id'=>'s admin']) !!}
                Male
                    </label>
                </div>
                <div class="radio">
                <label>
                    {!! Form::radio('gender', '2', ['class'=>'flat-red', 'id'=>'f admin']) !!}
                Female
                </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group">
                <label for="dob">Merital Status <span class="dengertext">*</span></label>
                <div class="radio">
                    <label>
                    {!! Form::radio('merital_status', '1', ['class'=>'flat-red']) !!}
                    Singel
                    </label>
                </div>
                <div class="radio">
                    <label>
                    {!! Form::radio('merital_status', '2', ['class'=>'flat-red']) !!}
                    Merried
                    </label>
                </div>
                <div class="radio">
                <label>
                    {!! Form::radio('merital_status', '3', ['class'=>'flat-red']) !!}
                    Divorced
                </label>
                </div>
            </div>
            <div class="form-group">
                <label for="dob">Email <span class="dengertext">*</span></label>
                {!! Form::text('email', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Enter Email','class' => 'form-control', 'data-error' => 'This email field is required')) !!}
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="dob">User Name<span class="dengertext">*</span></label>
                {!! Form::text('user_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Enter User Name','class' => 'form-control', 'data-error' => 'This user name field is required')) !!}
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="dob">Password <span class="dengertext">*</span></label>
                <input type="password" class="form-control" id="password" name="passwords" placeholder="Password" value="">
                <div id="pswd_info">
						<span id="letter" class="invalid">At least <strong>one letter</strong></span>
						<span id="capital" class="invalid">At least <strong>one capital letter</strong></span>
						<span id="number" class="invalid">At least <strong>one number</strong></span>
						<span id="length" class="invalid">Be at least <strong>8 characters</strong></span>
						<span id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></span>
				</div>
            </div>
            <div class="form-group has-feedback">
                <label for="dob">Confirm Password <span class="dengertext">*</span></label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" >
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="form-group">
                <label for="dob">Is Enebled <span class="dengertext">*</span></label>
                <div class="radio">
                <label>
                    {!! Form::radio('is_enebled', 'yes', ['class'=>'flat-red']) !!}
                Yes
                    </label>
                </div>
                <div class="radio">
                <label>
                    {!! Form::radio('is_enebled', 'no', ['class'=>'flat-red']) !!}
                No
                </label>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Role <span class="dengertext">*</span></label>
                <select name="role" class="form-control">
                @if ($roles->count())

                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $idrole == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>    
                    @endforeach

                    @endif
                </select>
            </div> 
            <div class="form-group">
                <label for="dob">Picture <span class="dengertext">*</span></label>
                {!! Form::file('image', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Picture','class' => 'form-control', 'data-error' => 'This user name field is required')) !!}
                <div class="help-block with-errors"></div>
                @if(Request::is('edit-user/*') )
                <img src="{{ asset($user->user_image)}}" width="30%">
                @endif
            </div>
            <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>