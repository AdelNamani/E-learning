<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function show(){
        $user = Auth::user();
        $lessons = $user->lessons;
        $chapters = [];
        foreach ($lessons as $lesson){
            array_push($chapters,$lesson->chapter);
        }
        $courses=[];
        foreach ($chapters as $chapter){
            array_push($courses,$chapter->course);
        }

        $courses = array_unique($courses);

        foreach($courses as $course){
            $count = 0;

            $score = 0;
            $chapters_with_quiz=0;
            foreach ($course->chapters as $chapter){
                if(count($chapter->questions)>0){
                    $chapters_with_quiz++;
                    if($chapter->users->contains(Auth::user())){
                        $user = $chapter->users->find(Auth::user()->id) ;
                        $score += $user->pivot->score ;
                    }
                }
            }
            if ($chapters_with_quiz==0 || ($score / $chapters_with_quiz >= 0.5)){
                $course->get_certificate = true;
            }else{
                $course->get_certificate = false;
            }

            foreach ($course->get_lessons() as $lesson){
                if ($lessons->contains($lesson)) $count ++;
            }
            $course->progress = $count / count($course->get_lessons());
        }

        return view('profile',['user'=>$user,'courses'=>$courses]);
    }

    public function edit(){
        $user = Auth::user();
        return view('profile_edit',['user'=>$user]);
    }

    public function update_info(Request $request){
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '',
        ]);

        if ($user->email != $request['email']) {

            $user->email_verified_at = null;
            $user->email = $request['email'];
            $user->sendEmailVerificationNotification();

        }

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
            return Redirect::back()->withErrors(['The specified password does not match the actual password']);
        }

    }


}
