<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\User;

use App\Clasess\UserClass;
use Carbon\Carbon;
use PDF;
use DB;
use Session;

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
                                    ->select(['users.id', 'users.user_image', 'users.first_name', 'users.middle_name',
                                    'users.last_name', 'user_name', 'users.role_id', 'users.is_enebled', 'users.email',
                                    'users.last_login_at', 'role.id as role_id', 'role.role_name']);
        $data = DataTables::of($user)
       
        /*
        if (request()->has('searchingfield')) {
            $data->filter(function ($query) {
                $query->where('users.user_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.first_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.middle_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
                $query->orWhere('users.last_name', 'like', "%" . request('searchingfield') . "%")->where('users.is_delete', '0');
        });
    }
    */
        
        ->addColumn('nomers', function($user) {
            return $user++;
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
            if (request()->has('roles')) {
                $query->where('users.role_id', 'like', "%" . request('roles') . "%")->where('users.is_delete', '0');
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
        $data->removeColumn('id');
        $data->rawColumns(['user_image', 'action', 'is_enebled', 'checkbox']);
        
        return $data->toJson();;
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
}
