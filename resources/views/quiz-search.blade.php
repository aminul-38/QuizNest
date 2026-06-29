@extends('layouts.home-layout')

@section('title')
| Search
@endsection

@push('css')
<style>
    :root {
        --primary: #7c4dff;
        --primary-dark: #6a3ef5;
        --bg-light: #f5f3ff;
        --text-dark: #2d3436;
        --border: #e9ecef;
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

    /* Empty Search Result */
    .empty-search {
        max-width: 700px;
        margin: 80px auto;
        text-align: center;
        background: white;
        padding: 50px 40px;
        border-radius: 28px;
        box-shadow: 0 10px 35px rgba(124, 77, 255, .08);
        border: 1px solid rgba(124, 77, 255, .08);
    }

    .empty-search-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: linear-gradient(135deg,
                rgba(124, 77, 255, .12),
                rgba(155, 109, 255, .18));
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-search-icon i {
        font-size: 3rem;
        color: var(--primary);
    }

    .empty-search h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 12px;
    }

    .empty-search p {
        color: #6c757d;
        max-width: 500px;
        margin: 0 auto 30px;
        line-height: 1.7;
    }

    .empty-search .search-key {
        color: var(--primary);
        font-weight: 700;
    }

    .empty-search-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-browse {
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: .3s;
    }

    .btn-browse:hover {
        transform: translateY(-2px);
        color: white;
    }

    .btn-clear-search {
        border: 2px solid var(--primary);
        color: var(--primary);
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: .3s;
    }

    .btn-clear-search:hover {
        background: var(--primary);
        color: white;
    }

    @media(max-width:768px) {
        .quiz-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    @if($quizzes->count())
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
                        <a href="#">
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
                    @if(session('user_id') && (session('user_role')=="Creator" || $quiz->has_participated))
                    <a href="{{ route('quiz.view', ['quizID' => $quiz->id]) }}"
                        class="btn-participate text-decoration-none">
                        View Quiz
                    </a>
                    @else
                    <a href="{{ route('quiz.start', ['quizID' => $quiz->id]) }}"
                        class="btn-participate text-decoration-none">
                        Participate Now
                    </a>
                    @endif
                    <a href="{{ route('leaderboard.quiz', ['quizID' => $quiz->id]) }}"
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
    <div class="empty-search">
        <div class="empty-search-icon">
            <i class="bi bi-search"></i>
        </div>
        <h2>No Quiz Found</h2>
        <p>
            We couldn't find any quizzes matching
            <span class="search-key">
                "{{ request('key') }}"
            </span>.
            Try a different keyword, search by creator name,
            or browse all available quizzes.
        </p>
        <div class="empty-search-actions">
            <a href="{{ route('home') }}"
                class="btn-browse">
                <i class="bi bi-grid me-2"></i>
                Browse Quizzes
            </a>
            <a href="javascript:history.back()"
                class="btn-clear-search">
                <i class="bi bi-arrow-left me-2"></i>
                Go Back
            </a>
        </div>
    </div>
    @endif
</div>
@endsection