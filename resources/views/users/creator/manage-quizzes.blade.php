@extends('layouts.profile-layout')

@section('title')
| Manage Quizzes
@endsection

@push('css')
<style>
    :root {
        --created-primary: #7c4dff;
        --created-text: #2d3436;
        --created-muted: #6c757d;
    }

    /* Created Quizzes Header */
    .created-quizzes-header {
        margin: 35px auto 25px;
        text-align: center;
    }

    .created-quizzes-title {
        position: relative;
        display: inline-block;
        margin: 0;
        color: var(--created-text);
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: -.4px;
    }

    .created-quizzes-title::after {
        content: "";
        display: block;
        width: 42px;
        height: 3px;
        margin: 8px auto 0;
        border-radius: 10px;
        background: var(--created-primary);
    }

    .created-quizzes-subtitle {
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

    /* Quiz Actions */
    .quiz-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: auto;
    }

    .quiz-actions a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    /* View Quiz */
    .btn-participate {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: linear-gradient(135deg, #7c4dff, #9b6dff);
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-participate:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(124, 77, 255, .25);
    }

    /* Leaderboard */
    .btn-view {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 2px solid var(--primary);
        background: white;
        color: var(--primary);
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-view:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Edit Quiz */
    .btn-edit-quiz {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: #f5f3ff;
        color: #6f42c1;
        border: 1px solid #ddd2ff;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-edit-quiz:hover {
        background: #ede7ff;
        color: #5e20db;
        border-color: #cbbaff;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(124, 77, 255, .12);
    }

    /* Delete Quiz */
    .btn-delete-quiz {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: #fff5f5;
        color: #dc3545;
        border: 1px solid #ffd6d9;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-delete-quiz:hover {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(220, 53, 69, .18);
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

    /* Showing Empty Quiz */
    .created-quizzes-empty {
        margin: 35px auto 35px;
        padding: 55px 25px;
        text-align: center;
        background: #ffffff;
        border: 1px solid rgba(124, 77, 255, .08);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .07);
    }

    .created-quizzes-empty-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        background: #f5f3ff;
        color: #7c4dff;
        font-size: 1.5rem;
    }

    .created-quizzes-empty-title {
        margin: 0 0 7px;
        color: #2d3436;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .created-quizzes-empty-text {
        margin: 0;
        color: #6c757d;
        font-size: .88rem;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .created-quizzes-header {
            margin-top: 25px;
        }

        .created-quizzes-title {
            font-size: 1.5rem;
        }

        .created-quizzes-subtitle {
            padding: 0 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    @if($quizzes->isNotEmpty())
    <div class="created-quizzes-header">
        <h2 class="created-quizzes-title">
            Manage Your Quizzes
        </h2>
        <span class="created-quizzes-subtitle">
            View, manage, and organize the quizzes you have created on QuizNest.
        </span>
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

                    <a href="{{ route('quiz.view', ['quizID' => $quiz->id]) }}"
                        class="btn-participate text-decoration-none">
                        <i class="bi bi-eye"></i>
                        View Quiz
                    </a>

                    <a href="{{ route('leaderboard.quiz', ['quizID' => $quiz->id]) }}"
                        class="btn-view text-decoration-none">
                        <i class="bi bi-bar-chart-line"></i>
                        Leaderboard
                    </a>

                    <a href="#"
                        class="btn-edit-quiz text-decoration-none">
                        <i class="bi bi-pencil-square"></i>
                        Edit
                    </a>

                    <a href="#"
                        class="btn-delete-quiz text-decoration-none">
                        <i class="bi bi-trash3"></i>
                        Delete
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
    <div class="created-quizzes-empty">
        <div class="created-quizzes-empty-icon">
            <i class="bi bi-journal-plus"></i>
        </div>
        <h3 class="created-quizzes-empty-title">
            Your Quiz Collection Is Empty
        </h3>
        <p class="created-quizzes-empty-text">
            Create your first quiz to start engaging learners and growing your collection on QuizNest.
        </p>
    </div>
    @endif
</div>
@endsection