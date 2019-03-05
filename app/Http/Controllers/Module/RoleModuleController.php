<?php

namespace App\Http\Controllers\Module;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MRoleModule;

class RoleModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
    }
}
