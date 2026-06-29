<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->has('user_id')) {
            $quizzes = Quiz::where('is_public', true)
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
            $quizType = 'Public';
            return view('index', compact('quizzes', 'quizType'));
        } else {
            $quizzes = Quiz::where('is_public', true)
                ->orderBy('id', 'desc')
                ->with('creator:id,name,profile_img_path')
                ->with('category')
                ->withCount('results as total_participant')
                ->paginate(6);
            $quizType = 'Public';
            return view('index', compact('quizzes', 'quizType'));
        }
    }

    public function filterByType(Request $request)
    {
        if ($request->quizType == 'private') {
            if (session()->has('user_id')) {
                $quizzes = Quiz::where('is_public', false)
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
                $quizType = 'Private';
                return view('index', compact('quizzes', 'quizType'));
            } else {
                $quizzes = Quiz::where('is_public', false)
                    ->orderBy('id', 'desc')
                    ->with('creator:id,name,profile_img_path')
                    ->with('category')
                    ->withCount('results as total_participant')
                    ->paginate(6);
                $quizType = 'Private';
                return view('index', compact('quizzes', 'quizType'));
            }
        } else {
            if (session()->has('user_id')) {
                $quizzes = Quiz::orderBy('id', 'desc')
                    ->with('creator:id,name,profile_img_path')
                    ->with('category')
                    ->withCount('results as total_participant')
                    ->withExists([
                        'results as has_participated' => function ($query) {
                            $query->where('participant_id', session('user_id'));
                        }
                    ])
                    ->paginate(6);
                $quizType = 'All';
                return view('index', compact('quizzes', 'quizType'));
            } else {
                $quizzes = Quiz::orderBy('id', 'desc')
                    ->with('creator:id,name,profile_img_path')
                    ->with('category')
                    ->withCount('results as total_participant')
                    ->paginate(6);
                $quizType = 'All';
                return view('index', compact('quizzes', 'quizType'));
            }
        }
    }

    public function search(Request $request)
    {
        $key = trim($request->key);

        if (session()->has('user_id')) {
            $quizzes = Quiz::with('creator:id,name,profile_img_path')
                ->with('category')
                ->withCount('results as total_participant')
                ->withExists([
                    'results as has_participated' => function ($query) {
                        $query->where('participant_id', session('user_id'));
                    }
                ])
                ->where(function ($query) use ($key) {
                    $query->where('title', 'LIKE', "%{$key}%")
                        ->orWhereHas('creator', function ($q) use ($key) {
                            $q->where('name', 'LIKE', "%{$key}%");
                        });
                })
                ->latest('id')
                ->paginate(6);
            return view('quiz-search', compact('quizzes'));
        } else {
            $quizzes = Quiz::with('creator:id,name,profile_img_path')
                ->with('category')
                ->withCount('results as total_participant')
                ->where(function ($query) use ($key) {
                    $query->where('title', 'LIKE', "%{$key}%")
                        ->orWhereHas('creator', function ($q) use ($key) {
                            $q->where('name', 'LIKE', "%{$key}%");
                        });
                })
                ->latest('id')
                ->paginate(6);
            return view('quiz-search', compact('quizzes'));
        }
    }

    public function quizStart(Request $request)
    {
        $quiz = Quiz::where('id', $request->quizID)
            ->with('creator:id,name,profile_img_path')
            ->withCount('results as total_participant')
            ->with('category')
            ->first();
        return view('quiz-start', compact('quiz'));
    }
}
