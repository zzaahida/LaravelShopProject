<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'img' => 'required|image|mimes:jpg,png,jpeg,svg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max+height=2000'
        ]);
        $fileName = time().$request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('users', $fileName, 'public');
        $validated['img'] = '/storage/'.$image_path;


        User::create($validated);

        return redirect()->route('products.index');
    }
}
