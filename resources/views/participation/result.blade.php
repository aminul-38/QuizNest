@extends('layouts.participation-layout')

@section('title')
| Play Quiz
@endsection

@push('css')
<style>
    :root {
        --primary: #7c4dff;
        --primary-dark: #6a3ef5;
        --success: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --bg-light: #f5f3ff;
        --text-dark: #2d3436;
    }

    .result-wrapper {
        max-width: 950px;
        margin: 40px auto 80px;
    }

    .result-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(124, 77, 255, .12);
        border: 1px solid rgba(124, 77, 255, .08);
    }

    /* Header */

    .result-header {
        padding: 25px 35px;
        background: #faf9ff;
        border-bottom: 1px solid rgba(124, 77, 255, .08);

        display: flex;
        align-items: center;
        gap: 20px;
    }

    .result-icon {
        width: 65px;
        height: 65px;
        flex-shrink: 0;

        border-radius: 18px;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);

        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
    }

    .result-title h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3436;
    }

    .result-title p {
        margin: 4px 0 0;
        color: #6c757d;
    }

    /* Body */

    .result-body {
        padding: 35px;
    }

    .score-box {
        text-align: center;
        background: var(--bg-light);
        border-radius: 24px;
        padding: 35px;
        margin-bottom: 30px;
    }

    .score-label {
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .score-value {
        font-size: 4rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    .score-subtitle {
        margin-top: 12px;
        color: #6c757d;
    }

    /* Stats */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #faf9ff;
        border-radius: 18px;
        padding: 20px;
        text-align: center;
    }

    .stat-card i {
        font-size: 1.8rem;
        margin-bottom: 10px;
        display: block;
    }

    .stat-card h3 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-card span {
        color: #6c757d;
        font-size: .9rem;
    }

    .correct i {
        color: var(--success);
    }

    .wrong i {
        color: var(--warning);
        /*  color: var(--danger); */
    }

    .unanswered i {
        color: #f59e0b;
    }

    .rank i {
        color: var(--warning);
    }

    .time i {
        color: #0ea5e9;
    }

    /* Message */

    .performance-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .performance-box h5 {
        color: #15803d;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .performance-box p {
        margin: 0;
        color: #166534;
    }

    /* Buttons */

    .result-actions {
        display: flex;
        gap: 15px;
    }

    .result-actions a {
        flex: 1;
        text-decoration: none;
        text-align: center;
        padding: 14px;
        border-radius: 14px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-primary-result {
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
    }

    .btn-primary-result:hover {
        transform: translateY(-2px);
    }

    .btn-outline-result {
        border: 2px solid var(--primary);
        color: var(--primary);
        background: white;
    }

    .btn-outline-result:hover {
        background: var(--primary);
        color: white;
    }

    @media(max-width:768px) {

        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .result-actions {
            flex-direction: column;
        }

        .score-value {
            font-size: 3rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="result-wrapper">
        <div class="result-card">

            <div class="result-header">
                <div class="result-icon">
                    <i class="bi bi-trophy-fill"></i>
                </div>
                <div class="result-title">
                    <h1>Quiz Completed!</h1>
                    <p>
                        Congratulations, your answers have been submitted successfully.
                    </p>
                </div>
            </div>

            <div class="result-body">
                <div class="score-box">
                    <div class="score-label">
                        Your Score
                    </div>
                    <div class="score-value">
                        {{ $result->gained_point }}
                    </div>
                    <div class="score-subtitle">
                        out of {{ $result->total_point }}
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card correct">
                        <i class="bi bi-check-circle-fill"></i>
                        <h3>
                            {{ $result->gained_point }}
                        </h3>
                        <span>Correct</span>
                    </div>
                    <div class="stat-card wrong">
                        <i class="bi bi-x-circle-fill"></i>
                        <h3>
                            {{ $result->wrong_answer }}
                        </h3>
                        <span>Wrong</span>
                    </div>
                    <div class="stat-card unanswered">
                        <i class="bi bi-dash-circle-fill"></i>
                        <h3>
                            {{ $result->total_point - ($result->gained_point + $result->wrong_answer) }}
                        </h3>
                        <span>Skipped</span>
                    </div>
                    <!-- <div class="stat-card rank">
                        <i class="bi bi-trophy-fill"></i>
                        <h3>#3</h3>
                        <span>Rank</span>
                    </div> -->
                    <!-- <div class="stat-card time">
                        <i class="bi bi-clock-fill"></i>
                        <h3>04:52</h3>
                        <span>Time Taken</span>
                    </div> -->
                </div>

                <div class="performance-box">
                    <h5>
                        Excellent Performance 🎉
                    </h5>
                    <p>
                        You scored higher than most participants.
                        Check the leaderboard to see your position.
                    </p>
                </div>

                <div class="result-actions">
                    <a href="{{ route('leaderboard.quiz',['quizID'=>$result->quiz_id]) }}"
                        class="btn-primary-result">
                        <i class="bi bi-bar-chart-fill me-2"></i>
                        View Leaderboard
                    </a>
                    <a href="{{ route('home') }}"
                        class="btn-outline-result">
                        <i class="bi bi-house-door me-2"></i>
                        Back To Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection