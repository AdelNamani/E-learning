<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Proposition;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{

    public function quiz(Request $request){

        $chapter = Chapter::findOrFail($request['id']);
        return view('quiz',['chapter' => $chapter ]);

    }

    public function quizSubmit(Request $request){
        $user =Auth::user();
        $chapter = Chapter::findOrFail($request['id']);
        $chapter->users()->detach($user->id);
        $chapter->users()->attach($user->id , ['score' => $request['score']]);
        return response(200);
    }

    public function quizCreate(Request $request){
        $chapter = Chapter::findOrFail($request['id']);
        return view('quiz_create',['chapter'=>$chapter]);
    }

    public function propositionAdd(Request $request){
        $proposition = new Proposition();
        $proposition->statement = $request['statement'];
        $proposition->question_id = $request['question_id'];
        $proposition->is_correct = $request['is_correct'];

        $proposition->save();
        return response(200);
    }

    public function questionAdd(Request $request){
        $question = new Question();
        $question->statement = $request['statement'];
        $question->chapter_id = $request['chapter_id'];

        $question->save();
        $id = $question->id;
        return response(json_encode($id));
    }

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
        //
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
    public function destroy(Chapter $chapter)
    {
        //
    }
}
