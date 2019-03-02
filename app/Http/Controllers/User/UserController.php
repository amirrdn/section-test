<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\User;
use App\Usercategory;

use App\Clasess\UserClass;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user                 = new UserClass;
    }
    public function index()
    {
        $role_id                    = $this->user->pluckRoles();
        $status                     = User::pluck('is_enebled');
        return view('user.index', compact('role_id', 'status'));
    }
    public function create()
    {
        $role_id                    = $this->user->pluckRoles();

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
        $user                       = User::join('role', 'users.role_id', 'role.id')->where('users.is_delete', '0')
                                    ->select('users.id', 'users.user_image', 'users.first_name', 'users.middle_name',
                                    'users.last_name', 'user_name', 'users.role_id', 'users.is_enebled', 'users.email',
                                    'users.last_login_at', 'role.id as role_id', 'role.role_name');
        return DataTables::of($user)
        ->filter(function ($query) {
            if (request()->has('name')) {
                $query->where('users.first_name', 'like', "%" . request('name') . "%");
            }
            if (request()->has('email')) {
                $query->where('users.email', 'like', "%" . request('email') . "%");
            }
            if (request()->has('user_name')) {
                $query->where('users.user_name', 'like', "%" . request('user_name') . "%");
            }
            if (request()->has('roles')) {
                $query->where('users.role_id', 'like', "%" . request('roles') . "%");
            }
            if (request()->has('status')) {
                $query->where('users.is_enebled', 'like', "%" . request('status') . "%");
            }
            

        })
       ->addColumn('usernames', function ($user) {
            return $user->first_name . ' '. $user->last_name;
        })
        ->addColumn('activity', function ($user) {
            return $user->last_login_at ;
        })
        ->addColumn('role_id', function ($user) {
            return $user->role_name ;
        })
       ->addColumn('image', function ($user) { 
            $url= asset($user->user_image);
            return '<img src="'.$url.'" border="0" width="30%" class="img-rounded img-responsive center-block" align="center" />';
        })
        ->addColumn('nomers', function($user) {
            return $user++;
        })
        ->addColumn('action', function ($user) {
            return '<a href="'. route('edit_user', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
               <a href="'. route('delete_user', $user->id) .'" class="btn btn-xs btn-danger" onclick=\'return confirm("Are you sure want to delete?")\'><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
        })
        ->addColumn('is_enebled', function ($user) {
            if($user->is_enebled == 'yes'){
                $dbs    = '<button class="btn btn-sm btn-primary">Enebled</button>';
            }else{
                $dbs    = '<button class="btn btn-sm btn-default">Disabled</button>';
            }
            return $dbs;
        })
        ->rawColumns(['image', 'action', 'is_enebled'])
        ->make(true);
    }
    public function edit($id)
    {
        $user                       = User::find($id);
        $role_id                    = $this->user->pluckRoles();

        return view('user.edit', compact('user', 'role_id'));
    }
    public function updete(Request $request, $id)
    {
        $users                      = $this->user->UpdateUser($request,$id);
        $request->session()->flash('alert-success', 'was successful insert!');
		return redirect()->route('user_list');
    }
    public function getCustomFilterData(Request $request)
    {
        $user                       = User::join('role', 'users.role_id', 'role.id')->where('email', $request->name);
        return DataTables::of($user)
        ->addColumn('usernames', function ($user) {
             return $user->first_name . ' '. $user->last_name;
         })
         ->addColumn('activity', function ($user) {
             return $user->last_login_at ;
         })
         ->addColumn('role_id', function ($user) {
             return $user->role_name ;
         })
        ->addColumn('image', function ($user) { 
             $url= asset($user->user_image);
             return '<img src="'.$url.'" border="0" width="50%" class="img-rounded img-responsive" align="center" />';
         })
         ->addColumn('nomers', function($user) {
             return $user++;
         })
         ->addColumn('action', function ($user) {
             return '<a href="'. route('edit_user', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a href="'. route('editcust', $user->id) .'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
         })
         ->addColumn('is_enebled', function ($user) {
             if($user->is_enebled == 'yes'){
                 $dbs    = '<button class="btn btn-sm btn-primary">Enebled</button>';
             }else{
                 $dbs    = '<button class="btn btn-sm btn-default">Disabled</button>';
             }
             return $dbs;
         })
         ->rawColumns(['image', 'action', 'is_enebled'])
         ->make(true);
    }
    public function delete($id)
    {
        $user           = User::FindOrFail($id)->update(array('is_delete'=> 1));
        $request->session()->flash('alert-success', 'was successful delete!');
		return redirect()->route('user_list');
    }
}
