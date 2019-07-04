<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use App\Proposition;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QuizController extends Controller
{
    public function quiz(Request $request){

        $chapter = Chapter::findOrFail($request['id']);
        $completed = true;
        foreach ($chapter->lessons as $lesson){
            if (!Auth::user()->lessons->contains($lesson)){
                $completed = false;
                break;
            }
        }

        return view('quiz',['chapter' => $chapter , 'completed'=>$completed ]);

    }

    public function quizSubmit(Request $request){
        $user =Auth::user();
        $chapter = Chapter::findOrFail($request['id']);
        $chapter->users()->detach($user->id);
        $chapter->users()->attach($user->id , ['score' => $request['score']]);

//        $score = 0;
//        $chapters_with_quiz=0;
//        $course = Course::findOrFail($chapter->course->id);
//        foreach ($course->chapters as $chapter){
//            if(count($chapter->questions)>0){
//                $chapters_with_quiz++;
//                if($chapter->users->contains(Auth::user())){
//                    $user = $chapter->users->find(Auth::user()->id) ;
//                    $score += $user->pivot->score ;
//                }
//            }
//        }
//
//        if ($chapters_with_quiz==0 || ($score / $chapters_with_quiz >= 0.5)){
//            return redirect(route('course.certificate',['id'=>$chapter->course->id]));
//        }

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

        if ($request['is_correct']==1){
            $question = Question::findOrFail($request['question_id']);
            foreach($question->propositions as $proposition){
                if ($proposition->is_correct){
                    return response(json_encode('A question must have only one correct proposition'),403);
                }

            }
        }


        $proposition = new Proposition();
        $proposition->statement = $request['statement'];
        $proposition->question_id = $request['question_id'];
        $proposition->is_correct = $request['is_correct'];
        $proposition->save();

        $id = $proposition->id;
        if ($id != null) {
            return response(json_encode($id),200);
        }
        else{
            return response(json_encode(['error'=>'Something went wrong refresh and try again']),403);
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
