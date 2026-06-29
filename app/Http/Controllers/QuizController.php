<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function viewQuiz(Request $request)
    {
        $isParticipant = Result::where('participant_id', session('user_id'))
            ->where('quiz_id', $request->quizID)
            ->exists();

        $quiz = Quiz::select('creator_id', 'is_public')
            ->findOrFail($request->quizID);

        $isCreator = $quiz->creator_id == session('user_id');
        $roleCreator = session('user_role') === 'Creator';

        $canView = $isParticipant
            || ($quiz->is_public && $roleCreator)
            || (!$quiz->is_public && $isCreator);

        if (!$canView) {
            return back();
        }

        $quiz = Quiz::with('creator:id,name,profile_img_path')
            ->with('category:id,name')
            ->withCount('results as total_participant')
            ->with([
                'questions' => function ($query) {
                    $query->select('id', 'quiz_id', 'question_description')
                        ->with([
                            'options' => function ($q) {
                                $q->select('id', 'question_id', 'option_description', 'is_correct');
                            }
                        ]);
                }
            ])
            ->findOrFail($request->quizID);
        return view('quiz-view', compact('quiz'));
    }
}
