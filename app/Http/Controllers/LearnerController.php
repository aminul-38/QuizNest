<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function myAttempts(Request $request)
    {
        if ($request->userID == session('user_id') && $request->userName == session('user_name')) {
            $quizzes = Quiz::whereHas(
                'results',
                function ($query) {
                    $query->where('participant_id', session('user_id'));
                }
            )
                ->orderBy('id', 'desc')
                ->with('creator:id,name,profile_img_path')
                ->with('category')
                ->withCount('results as total_participant')
                ->paginate(6);
            return view('users.learner.my-attempts', compact('quizzes'));
        } else {
            return redirect()->back();
        }
    }

    public function myResults(Request $request)
    {
        if ($request->userID == session('user_id') && $request->userName == session('user_name')) {
            $results = Result::where('participant_id', session('user_id'))
                ->with('quiz:id,title,number_of_question')
                ->get();
            return view('users.learner.my-results', compact('results'));
        } else {
            return redirect()->back();
        }
    }
}
