<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user ){
        return view('profile.index', ['user' => $user]);
    }
    public function edit(User $user){
        return view('profile.edit', ['user' => $user]);

    }
    public function update(Request $request, User $user)
    {
        if($request->file('img') != ''){

            $fileName = time().$request->file('img')->getClientOriginalName();
            $image_path = $request->file('img')->storeAs('users', $fileName, 'public');

            $user->update(['img' => '/storage/'.$image_path]);
        }
        $validated = $user->update([
            'name' => $request->input('name'),
            'account' =>$user->account + $request->input('account'),
        ]);

        return redirect()->route('profile.index')->with('message', __('messages.user_updated'));

    }

}
