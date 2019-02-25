<?php
 
namespace App\Clasess;

use Illuminate\Http\Request;
use App\User;

class UserClass {
    public function getNameUser($id)
    {
        $user           = User::find($id);
        if(!empty($user)){
            return $user;
        }
    }
}