@extends('layouts.home-layout')

@push('css')
<style>
    :root {
        --primary: #7c4dff;
        --primary-dark: #6a3ef5;
        --bg-light: #f5f3ff;
        --text-dark: #2d3436;
        --border: #e9ecef;
    }

    .quiz-type-selector {
        background: #fff;
        border-radius: 24px;
        padding: 20px 25px;
        margin-top: 20px;
        margin-bottom: 30px;
        border: 1px solid rgba(124, 77, 255, .08);
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        display: flex;
        align-items: center;
    }

    .quiz-type-selector .fw-bold {
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .quiz-dropdown {
        background: white;
        border: 2px solid #7c4dff;
        border-radius: 14px;
        padding: 12px 18px;
        text-align: left;
        font-weight: 600;
    }

    .dropdown-menu {
        border: none;
        border-radius: 16px;
        padding: 8px;
        box-shadow: 0 15px 40px rgba(124, 77, 255, .15);
    }

    .dropdown-item {
        border-radius: 10px;
        padding: 12px 15px;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background: #ede7ff;
        color: #7c4dff;
    }

    .dropdown-item.active {
        background: #7c4dff;
        color: white;
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

    @media(max-width:768px) {
        .quiz-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="quiz-type-selector row">
        <div class="col-md-6 my-auto">
            <h5 class="mb-0 fw-bold">
                Explore Quizzes
            </h5>
            <small class="text-muted">
                Find quizzes and challenge yourself
            </small>
        </div>

        <div class="col-md-6">
            <div class="dropdown">
                <button
                    class="btn quiz-dropdown dropdown-toggle w-100"
                    type="button"
                    data-bs-toggle="dropdown">
                    {{$quizType}} Quizzes
                </button>
                <ul class="dropdown-menu w-100">
                    <li>
                        <a class="dropdown-item {{ $quizType == 'Public' ? 'active disabled' : '' }}"
                            href="{{ route('home') }}">
                            Public Quizzes
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $quizType == 'Private' ? 'active disabled' : '' }}" href="{{ route('quiz.type',['quizType'=>'private']) }}">
                            Private Quizzes
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $quizType == 'All' ? 'active disabled' : '' }}" href="{{ route('quiz.type',['quizType'=>'all']) }}">
                            All Quizzes
                        </a>
                    </li>
                </ul>
            </div>
        </div>
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
</div>
@endsection

@push('scripts')
<script>
    //
</script>
@endpush