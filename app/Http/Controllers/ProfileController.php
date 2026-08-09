<?php

namespace App\Http\Controllers;

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
            //return $results;
            return view('users.learner.profile', compact('user', 'results'));
        } else if ($user->role == 'Creator') {
            return view('users.creator.profile', compact('user'));
        }
    }
}
