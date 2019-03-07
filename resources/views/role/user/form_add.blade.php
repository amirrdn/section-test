<div class="row">
    <div class="col-md-12">
        <div class="box-body">
            <div class="form-group">
                <label for="inputWarning">Role Name<span class="dengertext">*</span></label>
                <select name="role" class="form-control">
                    @foreach ($roles as $value)
                        <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                    @endforeach
                </select>
           </div>
           <div class="form-group">
                <label for="inputWarning">Module<span class="dengertext">*</span></label>
                <select name="module" class="form-control">
                    @foreach ($modules as $value)
                        <option value="{{ $value->id }}" {{ request()->get('role') == $value->id ? 'selected':'' }}>{{ $value->module_names }}</option>
                    @endforeach
                </select>
           </div>
           <div class="form-group">
                <div class="checkbox">
                    <label><input name="permission[]" type="checkbox" value="view">Can View</label>
                </div>
                <div class="checkbox">
                    <label><input name="permission[]" type="checkbox" value="create">Can Create</label>
                </div>
                <div class="checkbox">
                    <label><input name="permission[]" type="checkbox" value="edit">Can Edit</label>
                </div>
                <div class="checkbox">
                    <label><input name="permission[]" type="checkbox" value="delete">Can Delete</label>
                </div>
                <div class="checkbox">
                    <label><input name="permission[]" type="checkbox" value="print">Can Print</label>
                </div>
                <div class="checkbox">
                    <label><input name="permission[]" type="checkbox" value="export">Can Export</label>
                </div>
            </div>
        </div>
        <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
    </div>
</div>