<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::orderBy('created_at', 'DESC')->paginate(10);
        return view('module.index');
    }
    public function show()
    {
        $role                       = Role::query();
        return \DataTables::of($role)
        ->addColumn('action', function ($role) {
            return '<a href="'. route('rolesedit', $role->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
               <a href="'. route('rolesdelete', $role->id) .'" class="btn btn-xs btn-danger" onclick=\'return confirm("Are you sure want to delete?")\'><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
        })
        ->addColumn('status', function ($role) {
            if($role->is_delete == '1'){
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'is_delete' => 'required'
        ]);
        $role = Role::firstOrCreate([
            'name' => $request->name,
            'is_delete' => $request->is_delete
        ]);
        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> Ditambahkan']);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'is_delete' => 'required'
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->is_delete = $request->input('is_delete');
        $role->save();
        $request->session()->flash('alert-success', 'was successful update!');
        return redirect()->route('rolegroup')
                        ->with('success','Role updated successfully');
    }
    public function destroy(Request $request)
    {
        $id                    = $request->get('id');
        $role = Role::whereIn('id', $id)->update(['is_delete'=> 0]);
        $request->session()->flash('alert-success', 'was successful insert!');
		return response(['msg' => 'deleted']);
        //$role->delete();
        //return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> Dihapus']);
    }
    public function setRoles(Request $request)
    {
        $role = Role::findByName($request->role);
        $role->syncPermissions($request->permission);
        $request->session()->flash('alert-success', 'was successful set permissions!');
        //return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
        //return \Redirect::to('/users/role-permission?role='.$request->get('role'));
    }
}
