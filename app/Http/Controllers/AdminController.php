<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use App\Course ;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        return redirect(route('admin.users'));
    }
    public function users()
    {
        // $users = User::all() ;
        // Get All users without current admin 
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin_users', ['users' => $users]);
    }
    public function courses()
    {
        $courses = Course::all() ; 
        return view('admin_courses', ['courses' => $courses]);
    }
    public function check(Request $request)
    {
        $id = json_decode($request->getContent())->id  ;
        $type = json_decode($request->getContent())->type ;
        $set = json_decode($request->getContent())->set ;
        $user = User::findOrFail($id) ;
        switch ($type) {
            case 'admin':
                if($set) {
                    $user->is_admin = 1 ;
                } else {
                    $user->is_admin = 0 ;
                }
                $user->save() ;
                break;
            case 'teacher':
                if($set) {
                    $user->is_teacher = 1 ;
                } else {
                    $user->is_teacher = 0 ;
                }
                $user->save() ;
                break;
            default:
                break;
        }
            return response(404);
    }
}
