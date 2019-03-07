<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

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

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user                 = new UserClass;
    }
    public function index()
    {
        $role_id                    = Role::pluck('name', 'id');
        $status                     = User::pluck('is_enebled');
        return view('user.index', compact('role_id', 'status'));
    }
    public function create()
    {
        $role_id                    = Role::all()->pluck('name');

        return view('user.add', compact('role_id'));
    }
    public function store(Request $request)
    {
        $user                       = $this->user->CreateUser($request);
        $request->session()->flash('alert-success', 'was successful insert!');
		return redirect()->route('user_list');
    }
    public function getData(Request $request)
    {
        $roles = \Spatie\Permission\Models\Role::all();
        $user                       = User::with('roles')->where('users.is_delete', '0')
                                    ;
                                    //return json_encode($user->get());
        $data = DataTables::of($user)
        ->addColumn('nomers', function($user) {
            return $user++;
        })
        ->addColumn('role', function($user) {
           //$user->whereHas("roles")->get();
           foreach ($user->getRoleNames() as $role){
               return $role;
           }
        })
        ->addColumn('action', function ($user) {
            return '<a href="'. route('edit_user', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
               <a href="'. route('delete_user', $user->id) .'" class="btn btn-xs btn-danger" onclick=\'return confirm("Are you sure want to delete?")\'><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
        })
        ->addColumn('user_image', function ($user) { 
            $url= asset($user->user_image);
            if(!empty($url)){
                $img    = $url;
            }else{
                $img    = asset('admin/dist/img/avatar2.png');
            }
            return '<img src="'.$img.'" border="0" width="30%" class="img-rounded img-responsive center-block" align="center" />';
        })
        ->addColumn('checkbox', function($user) {
            return '<input type="checkbox" name="id[]" value="'.$user->id.'">' ;
        })
        ->addColumn('is_enebled', function ($user) {
            if($user->is_enebled == 'yes'){
                $dbs    = '<button class="btn btn-sm btn-primary">Enebled</button>';
            }else{
                $dbs    = '<button class="btn btn-sm btn-default">Disabled</button>';
            }
            return $dbs;
        })->filter(function ($query) {
            
            if (request()->has('email')) {
                $query->where('users.email', 'like', "%" . request('email') . "%")->where('users.is_delete', '0');
            }
            if (request()->has('user_name')) {
                $query->where('users.user_name', 'like', "%" . request('user_name') . "%")->where('users.is_delete', '0');
            }
            
        });
        if (!empty($request->get('name') )) {
            $data->filter(function ($query) {
                $query->where('users.user_name', 'like', "%" . request('name') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.first_name', 'like', "%" . request('name') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.middle_name', 'like', "%" . request('name') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.last_name', 'like', "%" . request('name') . "%")->where('users.is_delete', '0');
            });
        }
        if (!empty($request->get('searchingfield') )) {
            $data->filter(function ($query) {
                $query->where('users.user_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.first_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.middle_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.last_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
            });
        }
        if (!empty($request->get('statusd') )) {
            $data->filter(function ($query) {
                $query->where('users.is_enebled', 'like', request('statusd'));
            });
        }
        if (!empty($request->get('roleses') )) {
            $data->filter(function ($query) {
                $query->whereHas('roles', function ($queryd) {
                    return $queryd->where('id', Input::get('roleses'));
                });
            });
        }
        $data->removeColumn('id');
        $data->rawColumns(['user_image', 'action', 'is_enebled', 'checkbox']);
        
        return $data->toJson();;
    }
    public function edit($id)
    {
        $user                       = User::find($id);
        $idrole                     = $user->role_id;
        $roles                    = Role::select('name', 'id')->get();

        return view('user.edit', compact('user', 'roles', 'idrole'));
    }
    public function updete(Request $request, $id)
    {
        $users                      = $this->user->UpdateUser($request,$id);
        $request->session()->flash('alert-success', 'was successful Update!');
		return redirect()->route('user_list');
    }
    public function delete(Request $request,$id)
    {
        $user           = User::FindOrFail($id)->update(array('is_delete'=> 1));
        $request->session()->flash('alert-success', 'was successful delete!');
		return redirect()->route('user_list');
    }
    public function delete2(Request $request)
    {
        $id_user        = $request->get('id');
        $user           = User::whereIn('id',$id_user)->update(['is_delete'=> 1]);
        $request->session()->flash('alert-success', 'was successful delete!');
        Session::flash('message', 'This is a message!'); 
        return response(['msg' => 'deleted']);
    }
    public function downloadPDF(Request $request){
        $role       = $request->get('role_id');
        $name       = $request->get('name');
        $status     = $request->get('status');
        $user_name  = $request->get('user_name');


        $user1   = User::join('role', 'users.role_id', 'role.id');
        if(!empty($name)){
            $user = $user1->where('users.first_name', 'like', '%' . $name .'%')
                    ->orWhere('users.middle_name', 'like', '%' . $name .'%')
                    ->orWhere('users.last_name', 'like', '%' . $name .'%')
            ->get();
        }elseif(!empty($role) ){
            $user = $user1->where('users.role_id', 'like', '%' . $request->get('role_id') .'%')
            ->get();
        }elseif($request->email > 0){
            $user = $user1->where('users.email', 'like', '%' . $request->email .'%')
            ->get();
        }elseif(!empty($status)){
            $user = $user1->where('users.is_enebled','like', '%' . $status .'%')
            ->get();
        }elseif(!empty($user_name)){
            $user = $user1->where('users.user_name', 'like', '%' . $user_name .'%')
            ->get();
        }else{
            $user = $user1->get();
        }
        PDF::SetHeaderMargin(5);
		PDF::SetFooterMargin(18);
		PDF::setMargins(10,10,40);
        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        PDF::AddPage();
        
             PDF::writeHTML(view('user.pdf', compact('user'))->render());
             $filename = storage_path().'/forms_pdf/10006/26/4718326/tes.pdf';
             PDF::Output(public_path('customer').'/tes', 'F');
            PDF::Output('tes.pdf', 'I');
            PDF::download('invoice.pdf');
  
    }
    public function print(Request $request)
    {
        $role       = $request->get('role_id');
        $name       = $request->get('name');
        $status     = $request->get('status');
        $user_name  = $request->get('user_name');


        $user1   = User::join('role', 'users.role_id', 'role.id');
        if(!empty($name)){
            $user = $user1->where('users.first_name', 'like', '%' . $name .'%')
                    ->orWhere('users.middle_name', 'like', '%' . $name .'%')
                    ->orWhere('users.last_name', 'like', '%' . $name .'%')
            ->get();
        }elseif(!empty($role) ){
            $user = $user1->where('users.role_id', 'like', '%' . $request->get('role_id') .'%')
            ->get();
        }elseif($request->email > 0){
            $user = $user1->where('users.email', 'like', '%' . $request->email .'%')
            ->get();
        }elseif(!empty($status)){
            $user = $user1->where('users.is_enebled','like', '%' . $status .'%')
            ->get();
        }elseif(!empty($user_name)){
            $user = $user1->where('users.user_name', 'like', '%' . $user_name .'%')
            ->get();
        }else{
            $user = $user1->get();
        }
        return view('user.print', compact('user'));
    }
    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all()->pluck('name');
        return view('user.roles', compact('user', 'roles'));
    }
    public function setRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return redirect()->back()->with(['success' => 'Role Sudah Di Set']);
    }
    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        $permissions = null;
        $hasPermission = null;
        $roles = Role::all()->pluck('name');
        $pages = Permission::select('name', 'id')->where('parent_id', 0)->get();
        if (!empty($role)) {
            $getRole = Role::findByName($role);
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                //->where('role_id', $getRole->id)->get()->pluck('name', 'page_id')->all();
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
           // $permissions = Permission::where('permissions.parent_id', 0)->get();
           $permissions = MModules::select('id','module_names')->get();

            $permissions1 = new UserClass;
        }
        //return json_encode($permissions);
        return view('user.role_permission', compact('roles', 'permissions', 'hasPermission', 'permissions1', 'pages'));
    }
    public function addPermission(Request $request)
    {
        $this->validate($request, [
            //'name' => 'required|string|unique:permissions'
            'name' => 'required|string'
        ]);
        $name_permission = Permission::where('id', $request->parent_id)->get();
        $b_names = $name_permission->first();
        if(!empty($b_names)){
            $b_name = $b_names->name;
        }else{
            $b_name = '';
        }
        $permission = Permission::firstOrCreate([
            'name' => strtolower($b_name .' '. $request->name),
            'parent_id' => $request->parent_id
        ]);
        return redirect()->back();
    }
    public function setRolePermission(Request $request, $role)
    {
        $admin_role = Role::where('name',$role)->first();
        
        //$permission = Permission::where('name','like','%' . $request->permission .'%')->first()->name;
        $permission     = Permission::query();
        if($request->permission > 1){
            foreach($request->permission as $word){
                $permission->orWhere('name', 'LIKE', '%'.$word.'%');
            }
        }else{
            $permission->where('name','like','%' . $request->permission .'%')->first()->name;
        }
        $permission = $permission->distinct()->pluck('name');
        //return json_encode($permission);
        $admin_role->syncPermissions($permission);

        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }
    public function showuser()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('user.index2', compact('users'));
    }
}
