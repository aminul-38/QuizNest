<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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

    public function editProfile(Request $request)
    {
        if ($request->userID == session('user_id') && $request->userName == session('user_name')) {
            $user = User::select('id', 'name', 'email', 'phone', 'role', 'profile_img_path')
                ->where('id', session('user_id'))
                ->first();
            return view('users.edit-profile', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:11'],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $directory = public_path('images/profile_pictures');

            /* Deleting old picture */
            if (
                $user->profile_img_path &&
                $user->profile_img_path !== 'images/profile_pictures/default_profile_picture.png' &&
                File::exists(public_path($user->profile_img_path))
            ) {
                File::delete(public_path($user->profile_img_path));
            }

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($directory, $fileName);
            $user->profile_img_path =
                'images/profile_pictures/' . $fileName;
        }

        $user->save();

        session([
            'user_name' => $user->name,
            'user_profile_picture' => $user->profile_img_path,
        ]);

        return redirect()
            ->route('profile.show', [
                'userID' => $user->id,
                'userName' => $user->name,
            ])
            ->with('success', 'Your profile has been updated successfully.');
    }

    public function changePassword(Request $request)
    {
        if ($request->userID == session('user_id') && $request->userName == session('user_name')) {
            $user = User::select('id', 'name', 'email', 'phone', 'role', 'profile_img_path')
                ->where('id', session('user_id'))
                ->first();
            return view('users.change-password', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'Please log in to change your password.');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'The current password is incorrect.'
                ])
                ->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with(
            'success',
            'Your password has been changed successfully.'
        );
    }
}
