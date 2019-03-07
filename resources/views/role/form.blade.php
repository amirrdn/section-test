<div class="row">
    <div class="col-md-12">
        <div class="box-body">
            <div class="form-group">
                <label for="inputWarning">Role Name<span class="dengertext">*</span></label>
                {!! Form::text('name', null, array('required' => 'required', 'autofocus' => 'autofocus','placeholder' => 'Enter Role Name','class' => 'form-control', 'data-error' => 'This role name field is required')) !!}
                <div class="help-block with-errors"></div>
           </div>
           <div class="form-group">
                <label for="dob">Is Enebled <span class="dengertext">*</span></label>
                <div class="radio">
                <label>
                    {!! Form::radio('is_delete', '1', ['class'=>'flat-red']) !!}
                Enebled
                    </label>
                </div>
                <div class="radio">
                <label>
                    {!! Form::radio('is_delete', '0', ['class'=>'flat-red']) !!}
                Disabled
                </label>
                </div>
            </div>
        </div>
        <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
    </div>
</div>