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
        $user = User::select('id', 'name', 'email', 'phone', 'role', 'profile_img_path')
            ->where('id', $request->userID)
            ->first();
        $results = Result::where('participant_id', $user->id)
            ->with('quiz:id,title,number_of_question')
            ->get();
        $stats = (object)[
            'quiz_participated' => $results->count(),
            'total_points' => $results->sum('gained_point'),
        ];
        $quizzes = Quiz::whereHas(
            'results',
            function ($query) use ($user) {
                $query->where('participant_id', $user->id);
            }
        )
            ->orderBy('id', 'desc')
            ->with('creator:id,name,profile_img_path')
            ->with('category')
            ->withCount('results as total_participant')
            ->paginate(6);
        return view('users.learner.my-attempts', compact('user', 'stats', 'quizzes'));
    }

    public function myResults(Request $request)
    {
        $user = User::select('id', 'name', 'email', 'phone', 'role', 'profile_img_path')
            ->where('id', $request->userID)
            ->first();
        $results = Result::where('participant_id', $user->id)
            ->with('quiz:id,title,number_of_question')
            ->get();
        $stats = (object)[
            'quiz_participated' => $results->count(),
            'total_points' => $results->sum('gained_point'),
        ];
        return view('users.learner.my-results', compact('user', 'stats', 'results'));
    }
}
