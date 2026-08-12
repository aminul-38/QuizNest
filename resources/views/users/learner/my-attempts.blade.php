@extends('layouts.users-layout')

@push('css')
<style>
    :root {
        --created-primary: #7c4dff;
        --created-text: #2d3436;
        --created-muted: #6c757d;
    }

    /* Attempted Quizzes Header */
    .attempted-quizzes-header {
        margin: 35px auto 25px;
        text-align: center;
    }

    .attempted-quizzes-title {
        position: relative;
        display: inline-block;
        margin: 0;
        color: var(--created-text);
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: -.4px;
    }

    .attempted-quizzes-title::after {
        content: "";
        display: block;
        width: 42px;
        height: 3px;
        margin: 8px auto 0;
        border-radius: 10px;
        background: var(--created-primary);
    }

    .attempted-quizzes-subtitle {
        display: block;
        max-width: 600px;
        margin: 10px auto 0;
        color: var(--created-muted);
        font-size: .9rem;
        line-height: 1.6;
    }

    /* Quiz Card */
    .col-md-6 {
        margin-bottom: 20px;
    }

    .quiz-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 24px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        transition: all .3s ease;
        border: 1px solid rgba(124, 77, 255, .08);
    }

    .quiz-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 40px rgba(124, 77, 255, .15);
    }

    /* Creator */
    .creator-info-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .creator-img img {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ede7ff;
    }

    .creator-info a {
        text-decoration: none;
        font-size: 1rem;
        font-weight: 600;
        color: var(--primary);
    }

    .creator-info small {
        color: #6c757d;
    }

    /* Quiz Title */
    .quiz-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
    }


    /* Stats */
    .quiz-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 15px;
    }

    .stat-box {
        background: #faf9ff;
        border-radius: 15px;
        padding: 12px;
        text-align: center;
    }

    .stat-box h5 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
    }

    .stat-box span {
        font-size: .85rem;
        color: #6c757d;
    }

    /* Buttons */
    .quiz-actions {
        display: flex;
        gap: 10px;
        margin-top: auto;
        text-align: center;
    }

    .quiz-actions a {
        flex: 1;
    }

    .btn-participate {
        display: inline-block;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-participate:hover {
        transform: translateY(-2px);
    }

    .btn-view {
        display: inline-block;
        border: 2px solid var(--primary);
        background: white;
        color: var(--primary);
        padding: 10px 22px;
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-view:hover {
        background: var(--primary);
        color: white;
    }

    /* Pagination */
    .pagination .page-link {
        color: #7c4dff;
        border-radius: 10px;
        margin: 0 4px;
        border: none;
    }

    .pagination .page-item.active .page-link {
        background: #7c4dff;
        border-color: #7c4dff;
        color: white;
    }

    .pagination .page-link:hover {
        background: #ede7ff;
        color: #7c4dff;
    }

    /* No Attempted Quizzes */
    .attempted-quizzes-empty {
        margin: 35px auto;
        padding: 55px 25px;
        text-align: center;
        background: #ffffff;
        border: 1px solid rgba(124, 77, 255, .08);
        border-radius: 24px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .07);
    }

    .attempted-quizzes-empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: #f5f3ff;
        color: #7c4dff;
        font-size: 1.6rem;
    }

    .attempted-quizzes-empty-title {
        margin: 0 0 8px;
        color: #2d3436;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .attempted-quizzes-empty-text {
        max-width: 520px;
        margin: 0 auto;
        color: #6c757d;
        font-size: .9rem;
        line-height: 1.7;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .attempted-quizzes-header {
            margin-top: 25px;
        }

        .attempted-quizzes-title {
            font-size: 1.5rem;
        }

        .attempted-quizzes-subtitle {
            padding: 0 15px;
        }

        .quiz-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    @if($quizzes->isNotEmpty())
    <div class="attempted-quizzes-header">
        <h2 class="attempted-quizzes-title"> Your Quiz Attempts </h2> <span class="attempted-quizzes-subtitle"> Review the quizzes you have participated in and keep track of your quiz journey. </span>
    </div>
    <div class="row">
        @foreach($quizzes as $quiz)
        <div class="col-md-6">
            <div class="quiz-card">
                <div class="creator-info-wrapper">
                    <div class="creator-img">
                        <img src="{{ asset($quiz->creator->profile_img_path) }}"
                            alt="creator">
                    </div>
                    <div class="creator-info">
                        <a
                            href="{{ route('profile.show',['userID'=>$quiz->creator->id, 'userName'=>$quiz->creator->name]) }}">
                            {{ $quiz->creator->name }}
                        </a><br>
                        <small>
                            {{$quiz->created_at->format('d M Y • h:i A') }}
                        </small>
                    </div>
                </div>

                <div class="quiz-title">
                    {{ $quiz->title}}
                </div>
                <div class="quiz-stats">
                    <div class="stat-box">
                        <h5>
                            {{ $quiz->number_of_question }}
                        </h5>
                        <span>Questions</span>
                    </div>
                    <div class="stat-box">
                        <h5>
                            {{ $quiz->total_participant }}
                        </h5>
                        <span>Participants</span>
                    </div>
                    <div class="stat-box">
                        <h5>
                            @if($quiz->is_public)
                            Public
                            @else
                            Private
                            @endif
                        </h5>
                        <span>Type</span>
                    </div>
                    <div class="stat-box">
                        <h5>
                            {{ $quiz->category->name }}
                        </h5>
                        <span>Category</span>
                    </div>
                </div>

                <div class="quiz-actions">
                    <a
                        href="{{ route('quiz.view', ['quizID' => $quiz->id]) }}"
                        class="btn-participate text-decoration-none">
                        View Quiz
                    </a>
                    <a
                        href="{{ route('leaderboard.quiz', ['quizID' => $quiz->id]) }}"
                        class="btn-view text-decoration-none">
                        View Leaderboard
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $quizzes->links() }}
    </div>
    @else
    <div class="attempted-quizzes-empty">
        <div class="attempted-quizzes-empty-icon">
            <i class="bi bi-journal-x"></i>
        </div>
        <h3 class="attempted-quizzes-empty-title">
            No Quiz Attempts Yet
        </h3>
        <p class="attempted-quizzes-empty-text">
            You haven't attempted any quizzes yet. Explore available quizzes, participate in one, and your completed attempts will appear here.
        </p>
    </div>
    @endif
</div>
@endsection