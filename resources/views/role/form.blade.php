<div class="row">
    <div class="col-md-12">
        <div class="box-body">
            <div class="form-group">
                <label for="inputWarning">Role Name<span class="dengertext">*</span></label>
                {!! Form::text('role_name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Role Name','class' => 'form-control', 'data-error' => 'This role name field is required')) !!}
                <div class="help-block with-errors"></div>
           </div>
           <div class="form-group">
                <label for="dob">Is Enebled <span class="dengertext">*</span></label>
                <div class="form-group">
                    {!! Form::radio('role_status', '1', ['class'=>'flat-red']) !!}
                <label>Enebled
                    </label>
                </div>
                <div class="form-group">
                    {!! Form::radio('role_status', '0', ['class'=>'flat-red']) !!}
                <label>Disabled
                </label>
                </div>
            </div>
        </div>
        <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
    </div>
</div>