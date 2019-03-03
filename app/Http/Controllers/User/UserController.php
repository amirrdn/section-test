<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\User;

use App\Clasess\UserClass;
use Carbon\Carbon;
use PDF;

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
            if (request()->has('statusd')) {
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
            if(!empty($url)){
                $img    = $url;
            }else{
                $img    = asset('admin/dist/img/avatar2.png');
            }
            return '<img src="'.$img.'" border="0" width="30%" class="img-rounded img-responsive center-block" align="center" />';
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
        ->toJson();
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
        $request->session()->flash('alert-success', 'was successful Update!');
		return redirect()->route('user_list');
    }
    public function delete($id)
    {
        $user           = User::FindOrFail($id)->update(array('is_delete'=> 1));
        $request->session()->flash('alert-success', 'was successful delete!');
		return redirect()->route('user_list');
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
}
