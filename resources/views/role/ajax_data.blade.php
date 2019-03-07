<form id="insertrole">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <table class="table">
                                        <thead>
                                            <tr>
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
                                                        $is_enebled = 'dot dot-success col-md-offset-5';
                                                    }else{
                                                        $is_enebled = 'dot dot-danger col-md-offset-5';
                                                    }
                                                ?>
                                                    <input type="checkbox" name="permission[]" class="{{ $is_enebled }}" value="{{ $bs }}"
                                                            {{ in_array($bs, $hasPermission) ? 'checked':'' }}> {{ $bs }}
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
                                    </div>
                            </div>
                        <div>

