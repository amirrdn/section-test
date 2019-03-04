<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Models\MRole;

use App\Clasess\UserClass;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user                 = new UserClass;
    }
    public function index()
    {
        return view('role.index');
    }
    public function create()
    {
        return view('role.add');
    }
    public function store(Request $request)
    {
        $role                       = new MRole;

        $role->role_name            = $request->role_name;
        $role->role_status           = $request->role_status;

        $role->save();
        $request->session()->flash('alert-success', 'was successful insert!');
		return redirect()->route('roles');
    }
    public function show()
    {
        $role                       = MRole::query();
        return \DataTables::of($role)
        ->addColumn('action', function ($role) {
            return '<a href="'. route('rolesedit', $role->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
               <a href="'. route('rolesdelete', $role->id) .'" class="btn btn-xs btn-danger" onclick=\'return confirm("Are you sure want to delete?")\'><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
        })
        ->addColumn('status', function ($role) {
            if($role->role_status == '1'){
                $dbs    = 'Yes';
            }else{
                $dbs    = 'No';
            }
            return $dbs;
        })
        ->addColumn('checkbox', function($role) {
            return '<input type="checkbox" name="id[]" value="'.$role->id.'">' ;
        })
        ->rawColumns(['action', 'status', 'checkbox'])
        ->make(true);
    }
    public function edit($id)
    {
        $role                       = MRole::find($id);

        return view('role.edit', compact('role'));
    }
    public function update(Request $request, $id)
    {
        $role                       = MRole::find($id);

        $role->role_name            = $request->role_name;
        $role->role_status          = $request->role_status;

        $role->save();
        \Log::debug('Here is some debug information');
        $request->session()->flash('alert-success', 'was successful insert!');
		return redirect()->route('roles');
    }
    public function delete(Request $request, $id)
    {
        $role                       = MRole::FindOrFail($id)->update(array('role_status'=> 0));

        $request->session()->flash('alert-success', 'was successful insert!');
		return redirect()->route('roles');
    }
    public function delete2(Request $request)
    {
        $id_role                    = $request->get('id');
        $role                       = MRole::whereIn('id', $id_role)->update(['role_status'=> 0]);

        $request->session()->flash('alert-success', 'was successful insert!');
		return response(['msg' => 'deleted']);
    }
}
