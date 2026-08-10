<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = User::select('id', 'name', 'email', 'phone', 'role', 'profile_img_path')
            ->where('id', $request->userID)
            ->first();
        if ($user->role == 'Learner') {
            $results = Result::where('participant_id', $user->id)
                ->with('quiz:id,title,number_of_question')
                ->get();
            $stats = (object)[
                'quiz_participated' => $results->count(),
                'total_points' => $results->sum('gained_point'),
            ];
            //return $stats;
            //return $results;
            return view('users.learner.profile', compact('user', 'results', 'stats'));
        } else if ($user->role == 'Creator') {
            if (session()->has('user_id') && session('user_role') == 'Learner') {
                $quizzes = Quiz::where('creator_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->with('creator:id,name,profile_img_path')
                    ->with('category')
                    ->withCount('results as total_participant')
                    ->withExists([
                        'results as has_participated' => function ($query) {
                            $query->where('participant_id', session('user_id'));
                        }
                    ])
                    ->paginate(6);
                $stats = (object)[
                    'quiz_created' => $quizzes->count(),
                    'total_participant' => $quizzes->sum('total_participant'),
                ];
                //return $stats;
                return view('users.creator.profile', compact('user', 'quizzes', 'stats'));
            } else {
                $quizzes = Quiz::where('creator_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->with('creator:id,name,profile_img_path')
                    ->with('category')
                    ->withCount('results as total_participant')
                    ->paginate(6);
                $stats = (object)[
                    'quiz_created' => $quizzes->count(),
                    'total_participant' => $quizzes->sum('total_participant'),
                ];
                //return $stats;
                return view('users.creator.profile', compact('user', 'quizzes', 'stats'));
            }
            //return $quizzes;

        }
    }
}
