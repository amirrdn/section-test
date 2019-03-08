
<form id="insertrole">
@if (!empty($permissions))
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <table class="table">
        <thead>
            <tr>
                <th>Module</th>
                <th class="text-center">Can View</th>
                <th class="text-center">Can Create</th>
                <th class="text-center">Can Edit</th>
                <th class="text-center">Can Delete</th>
                <th class="text-center">Can Print</th>
                <th class="text-center">Can Export</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $key => $row)
            <tr>
                <td>{{ $row->module_names }}</td>
                @foreach($permissions1->permis($row->id) as $cey => $bs)
                <td>
                    <?php 
                        if(in_array($bs, $hasPermission) ? 'checked':''){
                            $is_enebled = 'p-icon p-round  col-md-offset-5';
                        }else{
                            $is_enebled = 'p-default p-round  col-md-offset-5';
                        }
                    ?>
                    <div class="pretty  {{ $is_enebled }}">
                        <input type="checkbox" name="permission[]" class="" value="{{ $bs }}"
                            {{ in_array($bs, $hasPermission) ? 'checked':'' }}> 
                        <div class="state p-success">
                            <label></label>
                        </div>
                    </div>
                </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right">
        <input type="hidden" name="role" value="<?php echo request()->get('role'); ?>">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-send"></i> Set Permission
        </button>
</form>

@endif