<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function quizLeaderboard(Request $request)
    {
        $quiz = Quiz::where('id', $request->quizID)
            ->with('creator:id,name,profile_img_path')
            ->withCount('results as total_participant')
            ->with('category')
            ->first();
        $results = Result::where('quiz_id', $request->quizID)
            ->with('participant:id,name')
            ->orderBy('gained_point', 'desc')
            ->get();
        return view('quiz-leaderboard', compact('quiz', 'results'));
    }
}
