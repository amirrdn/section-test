<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Models\MRole;
use Carbon;
class LoginController extends Controller
{
    public function attempt(Request $request,User $attempts)
    {
        $this->validate($request, [
            'email' => 'email|exists:users,email',
            'password' => 'required|min:6',
        ]);
        $attempts = ([
            'email' => $request->email,
            'password' => $request->password,
            'is_enebled' => 'yes',
        ]);
        $user = $user = User::where('email', '=', $attempts['email'])->first();
        if(!\Hash::check($attempts['password'], $user->password)){
            $request->session()->flash('msg', 'Warning !');
            $request->session()->flash('alert-danger', 'passowrd is not match');
            return redirect('login')->with([ 'msg','Not Active!']);
        }elseif (Auth::attempt($attempts, (bool) $request->remember)) {
            $cds = User::where('id',$user->id)->update(['last_login_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()]);;
            return redirect()->intended('/');
        }
        $cekstatus	= User::where('is_enebled','no')->get();
		if($cekstatus = 1){
			$request->session()->flash('alert-danger', 'Your Account is Pennding for information contact your IT');
			return redirect('login')->with([ 'msg','Not Active!']);
		}
    }
}
