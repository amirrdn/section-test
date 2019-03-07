<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\MPages;
use App\Models\MModules;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Clasess\UserClass;
use Carbon\Carbon;
use PDF;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

class UserRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user                 = new UserClass;
    }
    public function create()
    {
        $names                      = 0;
        $roles                      = Role::all()->pluck('name');
        $modules                    = MModules::select('module_names', 'id')->get();
        return view('role.user.add', compact('roles', 'names', 'modules'));
    }
    public function store(Request $request)
    {
        $nm_module  = MModules::find($request->module);
        $cek        = Permission::where('name', 'like', '%' .$request->module. '%')->get();
        if($cek = 1){
            $inputbussiness					= Input::all();
            for ($bus = 0; $bus < count(Input::get('permission')); $bus++)
            {
                $permission = Permission::create([
                    'name' => strtolower($nm_module->module_names .' '. $inputbussiness['permission'][$bus]),
                    'module'=> $request->module,
                    'parent_id' => $request->parent_id
                ]);
            }
        }else{
        $permission = Permission::firstOrCreate([
            'name' => strtolower($nm_module .' '. $request->name),
            'parent_id' => $request->parent_id
        ]);
        }
        $admin_role         = Role::where('name',$request->role)->first();
        $permissions        = Permission::query();
        if($request->permission > 1){
            foreach($request->permission as $word){
                $permissions->orWhere('name', 'LIKE', '%'.$word.'%');
            }
        }else{
            $permissions->where('name','like','%' . $request->permission .'%')->first()->name;
        }
        $permissions = $permissions->distinct()->pluck('name');
        $admin_role->givePermissionTo($permissions);
        return redirect()->back();
    }
    public function edit(Request $request, $id)
    {
        $modules                    = MModules::pluck('module_names', 'id');
        /*
        $role = $request->get('role');
        $permissions = null;
        $hasPermission = null;
        $name_permission = new UserClass;

        $roles = Role::all()->pluck('name');
        
        if (!empty($role)) {
            $getRole = Role::findByName($role);
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
                
                $permissions = Permission::join('role_has_permissions', 'permissions.id', 'role_has_permissions.permission_id')
                ->where('module', $id)->pluck('name');
            }
            */
            $role = $request->get('role');
            $permissions = null;
            $hasPermission = null;
    
            $roles = Role::all()->pluck('name');
    
            if (!empty($role)) {
                $getRole = Role::findByName($role);
                $hasPermission = DB::table('role_has_permissions')
                    ->select('permissions.name')
                    ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->where('role_id', $getRole->id)->get()->pluck('name')->all();
                $permissions = Permission::all()->where('module', $id)->pluck('name');
            }
        $jumlah = 1;
        $hasil = implode(" ", array_slice(explode(" ", $permissions), 0, $jumlah));
        //return json_encode($permissions);
        return view('role.user.edit', compact('name_permission','roles', 'permissions', 'hasPermission', 'permissions1', 'pages', 'modules'));
    }
}
