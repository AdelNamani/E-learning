<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CourseRequest;
use Storage;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        foreach ($courses as $course){
            $course->teacher = $course->user->first_name.' '.$course->user->last_name;
            $course->photo  = Storage::url('uploads/'.$course->photo);

        }
        return view('home' , ['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course_create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //  
            $course = Course::create([
                'name' => $request['name'] , 
                'description' => $request['description']  , 
                'user_id' => Auth::user()->id 
            ]) ;
            if($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = $course->id . '.' . $image->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs('uploads', $image , $name);
                $course->photo =  $name  ; 
            }
            $course->save() ;
            return redirect(route('course.show' , ['id' => $course->id ])) ;
        }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $course=Course::findOrFail($request['id']);
        $course->teacher = $course->user->first_name.' '.$course->user->last_name;
        return view('course_show' , ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $course = Course::find($request['id']);
        return view('course_edit' , ['course' => $course ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $course = Course::find($request['id']);
        $course->name = $request['name'] ;
        $course->description = $request['description'] ;
        if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = $course->id . '.' . $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('uploads', $image , $name);
            $course->photo =  $name  ; 
        }
        $course->save() ;
        return redirect(route('course.show' , ['id' => $course->id ])) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $course = Course::find($request['id']);
        $course->delete() ;
        return redirect(route('teacher.courses')) ;
    }

    public function details(Request $request)
    {
        $course = Course::find($request['id']);
        $chapters = $course->chapters ;
        return view('course_details' , ['chapters' => $chapters ]) ;
    }
}
