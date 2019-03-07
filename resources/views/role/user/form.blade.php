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
                    <option value="null">Pilih</option>
                    @foreach ($modules as $value)
                        <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                    @endforeach
                </select>
           </div>
           <div class="form-group">
               @foreach ($permissions as $key => $row)
               <?php
                    $jumlah = 1;
                    $hasil = implode(" ", array_slice(explode(" ", $row), 1, $jumlah));
               ?>
               
               <input type="checkbox" 
                                                            name="permission[]" 
                                                            class="dot dot-success" 
                                                            value="{{ $hasil }}"
                                                            {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                            > {{ $hasil }} <br>
              @endforeach
             
                <!--
                <div class="checkbox">
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
                -->
               
            </div>
        </div>
        <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
    </div>
</div>