<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'video' => ['required','regex:/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+/'],
            'chapter_id' => 'required|integer'
        ]);

        $lesson = new Lesson();
        $lesson->name  = $request['name'];
        $lesson->video = $request['video'];
        $lesson->chapter_id = $request['chapter_id'];
        $lesson->save();

        $id = $lesson->id;
        if($id) return json_encode($id);
        else return response(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $lesson=Lesson::findOrFail($request['id']);
        return view('lesson_show' , ['lesson' => $lesson]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request['id']==null) return response(403);
        else{
            Lesson::destroy($request['id']);
            return response(200);
        }
    }

    public function complete(Request $request){
        $user = Auth::user();
        $lesson = Lesson::findOrFail($request['id']);
        $lesson->users()->attach($user->id);
        return response(200);
    }
}
