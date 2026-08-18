<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function manageQuizzes(Request $request)
    {
        if ($request->userID == session('user_id') && $request->userName == session('user_name')) {
            $quizzes = Quiz::where('creator_id', $request->userID)
                ->orderBy('id', 'desc')
                ->with('creator:id,name,profile_img_path')
                ->with('category')
                ->withCount('results as total_participant')
                ->paginate(6);
            return view('users.creator.manage-quizzes', compact('quizzes'));
        } else {
            return redirect()->back();
        }
    }

    public function createQuiz(Request $request)
    {
        if ($request->userID != session('user_id') || $request->userName != session('user_name')) {
            return redirect()->back();
        }

        return view('users.creator.create-quiz');
    }
}
