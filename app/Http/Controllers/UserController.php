<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(){
        $user = Auth::user();
        return view('profile',['user'=>$user]);
    }

    public function edit(){
        $user = Auth::user();
        return view('profile_edit',['user'=>$user]);
    }

    public function update_info(Request $request){
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '',
        ]);

        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];

        $user->save();

        return redirect(route('profile'));
    }

    public function update_password(Request $request){
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if (Hash::check($request['old_password'],$user->getAuthPassword())){
            $user->password = Hash::make($request['password']);
            $user->save();
            return redirect(route('profile'));

        }
        else{
            return 'error';
        }

    }


}
