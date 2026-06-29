<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use function PHPSTORM_META\type;

class ParticipationController extends Controller
{
    public function participate(Request $request)
    {
        $quiz = Quiz::with([
            'questions' => function ($query) {
                $query->select('id', 'quiz_id', 'question_description')
                    ->inRandomOrder()
                    ->with([
                        'options' => function ($q) {
                            $q->select('id', 'question_id', 'option_description')
                                ->inRandomOrder();
                        }
                    ]);
            }
        ])
            ->findOrFail($request->quizID);

        if (!$quiz->is_public && $request->access_code != $quiz->private_code) {
            return redirect()->back()
                ->withErrors([
                    'code_error' => 'Oops! The access code does not match this quiz. Please check the code and try again.'
                ]);
        }

        // check if already attempted the quiz
        if (Result::where([
            ['participant_id', session('user_id')],
            ['quiz_id', $quiz->id],
        ])->exists()) {
            return redirect()->back()
                ->withErrors([
                    'already_attempted' => 'Looks like you have already completed this quiz. Check your result instead!'
                ]);
        }

        Result::create([
            'participant_id' => session('user_id'),
            'quiz_id' => $quiz->id,
            'total_point' => $quiz->number_of_question,
            'gained_point' => 0,
            'wrong_answer' => 0,
        ]);
        return view('participation.participate', compact('quiz'));
    }

    public function submit(Request $request)
    {
        if (!$request->answers) {
            return redirect()->route('participation.result', ["quizID" => $request->quizID]);
        }
        $quiz = Quiz::select('id')
            ->with([
                'questions:id,quiz_id',
                'questions.options:id,question_id,is_correct'
            ])
            ->findOrFail($request->quizID);

        $questionMap = [];
        foreach ($quiz->questions as $question) {
            $questionMap[$question->id] = [];
            foreach ($question->options as $option) {
                $questionMap[$question->id][$option->id] = $option->is_correct;
            }
        }

        $totalPoint = 0;
        $wrongAnswer = 0;
        foreach ($request->answers as $questionId => $optionId) {
            if (!isset($questionMap[$questionId])) {
                return back()->withErrors([
                    'question_tampered' => 'Something went wrong!'
                ]);
            }
            if (!isset($questionMap[$questionId][$optionId])) {
                return back()->withErrors([
                    'option_tampered' => 'Something went wrong!'
                ]);
            }
            if ($questionMap[$questionId][$optionId]) {
                $totalPoint++;
            } else {
                $wrongAnswer++;
            }
        }
        Result::where('participant_id', session('user_id'))
            ->where('quiz_id', $quiz->id)
            ->update([
                'gained_point' => $totalPoint,
                'wrong_answer' => $wrongAnswer
            ]);
        $url = URL::signedRoute(
            'participation.result',
            now()->addMinutes(5),
            ['quizID' => $quiz->id]
        );

        return redirect()->to($url);
    }

    public function result(Request $request)
    {
        $result = Result::where('participant_id', session('user_id'))
            ->where('quiz_id', $request->quizID)
            ->first();
        return view('participation.result', compact('result'));
    }
}
