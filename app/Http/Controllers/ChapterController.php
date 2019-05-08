<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Proposition;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
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
            'support' => 'mimes:pdf'
        ]);

        $chapter = new Chapter();
        $chapter->name = $request['name'];
        $chapter->course_id = $request['id'];
        $chapter->save();

        if ($request->hasFile('support')){
            $name = strval($chapter->id) . '.' . $request->file('support')->getClientOriginalExtension();
            $path = $request->file('support')->storeAs('public/uploads/chapter', $name);
            $paths = explode('/', $path);
            $correct_path = $paths[1] . '/' . $paths[2] . '/' . $name;
            $chapter->support = $correct_path;
            $chapter->save();
        }

        return redirect(route('course.chapters',['id'=>$request['id']]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $chapter = Chapter::findOrFail($request['id']);
        $course_id = $chapter->course_id;
        $chapter->delete();
        return redirect(route('course.chapters',['id'=>$course_id]));
    }

    public function lessons(Request $request)
    {
        $chapter = Chapter::findOrFail($request['id']);
        return view('chapter_lessons', ['chapter' => $chapter]);

    }
}
