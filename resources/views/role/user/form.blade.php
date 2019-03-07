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
               @foreach ($permissions as $key => $row)
               <?php
                    $jumlah = 1;
                    $hasil = implode(" ", array_slice(explode(" ", $row), 1, $jumlah));
               ?>
               
               <input type="checkbox" 
                                                            name="permission[]" 
                                                            class="dot dot-success" 
                                                            value="{{ $row }}"
                                                            {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                            > {{ $hasil }} <br>
              @endforeach
            </div>
        </div>
        <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
    </div>
</div>