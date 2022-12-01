<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request){
        $users = null;
        $users = User::with('role')->get();
        return view('adm.roles', ['users'=>$users]);
    }
}
