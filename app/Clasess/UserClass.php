<?php
 
namespace App\Clasess;

use Illuminate\Http\Request;
use App\User;
use App\Models\MRole;
use App\Models\MPages;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;
use File;
use Illuminate\Support\Facades\Input;

class UserClass {
    public function getNameUser($id)
    {
        $user           = User::find($id);
        if(!empty($user)){
            return $user;
        }
    }
    public function pluckRoles()
    {
        return MRole::where('role_status', 1)->pluck('role_name', 'id');
    }
    public function nameroles()
    {
        return MRole::pluck('role_name');
    }
    public function UpdateUser(Request $request, $id)
    {
        $nmttd		                = $request->user_name;
        $now                        = \Carbon\Carbon::now();
        $year                       = date('Y', strtotime($now));
        $month                      = date('m', strtotime($now));
        $days                       = date('d', strtotime($now));
        if($request->image){
            $bs                         = Input::file('image')->getClientOriginalExtension();
            $nombreCarpeta              = preg_replace('/\s+/', '.', $year . "/" . $month . "/" . $days);
            $fileimg                    = preg_replace('/\s+/', '', $nmttd) . '.' .$bs;

            $post_imgs                  = 'img/user/'.$nombreCarpeta .'/' .$fileimg;
            $path                       = base_path() .'/public/img/user/'.$nombreCarpeta;

            $imageName = $nmttd . '.' . 
            $request->file('image')->getClientOriginalExtension();            
            $request->file('image')->move($path, preg_replace('/\s+/', '', $imageName));
        }else{
            $post_imgs                  = $request->user_image;
        }

        if($request->passwords){
            $pass                   = bcrypt($request->passwords);
        }else{
            $pass                   = $request->password;
        }
        $user                       = User::find($id);
        
        $user->email                = $request->email;
        $user->password             = $pass;
        $user->first_name           = $request->first_name;
        $user->middle_name          = $request->middle_name;
        $user->last_name            = $request->last_name;
        $user->identity_no          = $request->identity_no;
        $user->mobile_phone         = $request->mobile_phone;
        $user->date_birth_day       = date('y-m-d', strtotime($request->date_birth_day));
        $user->quatification        = $request->quatification;
        $user->gender               = $request->gender;
        $user->merital_status       = $request->merital_status;
        $user->user_name            = $request->user_name;
        $user->is_enebled           = $request->is_enebled;
        $user->role_id              = $request->role_id;
        $user->user_image           = $post_imgs;
        $user->role                 = $request->role;

        $user->save();
        $user->assignRole($request->role);
        return $user;
    }
    public function CreateUser(Request $request)
    {
        $nmttd		                = $request->user_name;
        $now                        = \Carbon\Carbon::now();
        $year                       = date('Y', strtotime($now));
        $month                      = date('m', strtotime($now));
        $days                       = date('d', strtotime($now));
        if($request->image){
            $bs                         = Input::file('image')->getClientOriginalExtension();
            $nombreCarpeta              = preg_replace('/\s+/', '.', $year . "/" . $month . "/" . $days);
            $fileimg                    = preg_replace('/\s+/', '', $nmttd) . '.' .$bs;

            $post_imgs                  = 'img/user/'.$nombreCarpeta .'/' .$fileimg;
            $path                       = base_path() .'/public/img/user/'.$nombreCarpeta;

            $imageName = $nmttd . '.' . 
            $request->file('image')->getClientOriginalExtension();            
            $request->file('image')->move($path, preg_replace('/\s+/', '', $imageName));
        }else{
            $post_imgs                  = asset('admin/dist/img/avatar2.png');
        }

        $user                       = new User;
        
        $user->email                = $request->email;
        $user->password             = bcrypt($request->passwords);
        $user->first_name           = $request->first_name;
        $user->middle_name          = $request->middle_name;
        $user->last_name            = $request->last_name;
        $user->identity_no          = $request->identity_no;
        $user->mobile_phone         = $request->mobile_phone;
        $user->date_birth_day       = date('y-m-d', strtotime($request->date_birth_day));
        $user->quatification        = $request->quatification;
        $user->gender               = $request->gender;
        $user->merital_status       = $request->merital_status;
        $user->user_name            = $request->user_name;
        $user->is_enebled           = $request->is_enebled;
        $user->role_id              = $request->role_id;
        $user->user_image           = $post_imgs;
        $user->role                 = $request->role;

        $user->save();
        $user->assignRole($request->role);
        return $user;
    }
    Public function getPage($name)
    {
        $pages  = Permission::join('pages', 'permissions.page_id', 'pages.id')->where('permissions.name','like', $name)->groupBy('pages.id');
        if(!empty($pages)){
            return $pages->get();
        }
    }
    public function permis($id)
    {
        return Permission::where('module',$id)->pluck('name');
    }
    public function searchpermission($name)
    {
        return Permission::where('name', 'like', '%'.$name.'%')->pluck('name');
    }
}