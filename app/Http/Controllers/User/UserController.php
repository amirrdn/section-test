<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\User;
use App\Usercategory;

use App\Clasess\UserClass;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user                 = new UserClass;
    }
    public function index()
    {
        return view('user.index');
    }
    public function getData()
    {
        $user                       = User::join('role', 'users.role_id', 'role.id');
        return Datatables::of($user)
        ->addColumn('images', function ($user) {
            return '<img src="'.$user->user_image.'" class="img-responsive" widht="50%">';
        })
        ->addColumn('usernames', function ($user) {
            return $user->first_name . ' '. $user->last_name;
        })
        ->addColumn('action', function ($user) {
            return '<a href="'. route('edit_user', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
               <a href="'. route('editcust', $user->id) .'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
        })
        ->make(true);
    }
    public function edit($id)
    {
        $user                       = User::find($id);

        return view('user.edit', compact('user'));
    }
}
