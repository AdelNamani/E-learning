<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Proposition;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
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
        if ($chapter->course->user_id != Auth::id()) abort(403);
        return view('quiz_create',['chapter'=>$chapter]);
    }

    public function propositionAdd(Request $request){
        $request->validate([
           'statement' => 'required|min:3|max:300',
            'question_id' => 'required|integer',
            'is_correct' => 'required|boolean'
        ]);

        $proposition = new Proposition();
        $proposition->statement = $request['statement'];
        $proposition->question_id = $request['question_id'];
        $proposition->is_correct = $request['is_correct'];
        $proposition->save();

        $id = $proposition->id;
        if ($id != null) {
            return response(json_encode($id));
        }
        else{
            return response(403);
        }
    }

    public function questionAdd(Request $request){
        $request->validate([
            'statement' => 'required|min:3|max:300',
            'chapter_id' => 'required|integer',
        ]);

        $question = new Question();
        $question->statement = $request['statement'];
        $question->chapter_id = $request['chapter_id'];
        $question->save();
        $id = $question->id;
        return response(json_encode($id));
    }

    public function propositionDelete(Request $request){
        $proposition = Proposition::findOrFail($request['id']);
        $proposition->delete();
        return response(200);
    }

    public function questionDelete(Request $request){
        $question = Question::findOrFail($request['id']);
        $question->delete();
        return response(200);
    }
}
