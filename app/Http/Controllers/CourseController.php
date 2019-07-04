<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        $courses = Course::where('state','=','approved')->get()->take('5');
        foreach ($courses as $course) {
            $course->teacher = $course->user->first_name . ' ' . $course->user->last_name;
        }
        return view('home', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //  
        $course = Course::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'user_id' => Auth::user()->id
        ]);
        if ($request->hasFile('photo')) {
            $name = strval($course->id) . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $request->file('photo')->storeAs('public/uploads/course', $name);
            $paths = explode('/', $path);
            $correct_path = $paths[1] . '/' . $paths[2] . '/' . $name;
            //dd($path,$paths,$correct_path);
            $course->photo = $correct_path;
        }
        $course->save();
        return redirect(route('course.chapters', ['id' => $course->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $course = Course::findOrFail($request['id']);
        $course->teacher = $course->user->first_name . ' ' . $course->user->last_name;
        if($course->state=='approved'){
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

            $completed=  ($chapters_with_quiz==0 || ($score / $chapters_with_quiz >= 0.5)) ? true : false;

            return view('course_show', ['course' => $course,'completed'=>$completed]);
        }
        else {
            return view('course_show', ['course' => $course]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $course = Course::findOrFail($request['id']);
        if ($course->user_id != Auth::id()) abort(404);
        return view('course_edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $course = Course::findOrFail($request['id']);
        if ($course->user_id != Auth::id()) abort(404);
        $course->name = $request['name'];
        $course->description = $request['description'];
        if ($request->hasFile('photo')) {
            $name = strval($course->id) . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $request->file('photo')->storeAs('public/uploads/course', $name);
            $paths = explode('/', $path);
            $correct_path = $paths[1] . '/' . $paths[2] . '/' . $name;
            $course->photo = $correct_path;
        }
        $course->save();
        return redirect(route('course.show', ['id' => $course->id]));
    }

    public function updateState(Request $request){
        $course = Course::findOrFail($request['id']);
        if ($course->user_id != Auth::id()) abort(404);
        $course->state = $request['state'];
        $course->save();
        return redirect(route('teacher.courses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $course = Course::findOrFail($request['id']);
        if ($course->user_id != Auth::id()) abort(405);
        $course->delete();
        return redirect(route('teacher.courses'));
    }

    public function chapters(Request $request)
    {
        $course = Course::findOrFail($request['id']);
        if ($course->user_id != Auth::id()) abort(403);
        return view('course_chapters', ['course' => $course]);
    }

    public function search(Request $request){
        $courses=Course::where('name','like',"%{$request->input('q')}%")->select('name','id')->get()->take('5');
        return json_encode($courses);
    }

    public function certificate(Request $request){
        $score = 0;
        $chapters_with_quiz=0;
        $course = Course::findOrFail($request['id']);
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
//            return [
//                'user' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
//                'course' => $course->name,
//                'teacher' => $course->user->first_name . ' ' . $course->user->last_name
//            ] ;
            $certif= "<h1>Certificate</h1>
                <h2>For : ". Auth::user()->first_name . " " . Auth::user()->last_name . "  </h2>
                <h2>For completing ". $course->name ." course</h2>
                <br>
                <h3>Teacher : " .$course->user->first_name ." " .$course->user->last_name ."</h3>";
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($certif)->setPaper('a4', 'landscape');
            return $pdf->stream();
        }
        else{
            abort(403);
        }
    }
}
