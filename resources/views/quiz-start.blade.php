@extends('layouts.view-quiz-layout')

@section('title')
| Quiz Start
@endsection

@push('css')
<style>
    :root {
        --primary: #7c4dff;
        --primary-dark: #6a3ef5;
        --bg-light: #f5f3ff;
        --text-dark: #2d3436;
    }

    .participation-wrapper {
        max-width: 900px;
        margin: 40px auto 80px;
    }

    .start-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        border: 1px solid rgba(124, 77, 255, .08);
    }

    .note-box {
        display: flex;
        gap: 18px;
        align-items: flex-start;
        background: #fff8db;
        border: 1px solid #ffe69c;
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .note-icon {
        width: 55px;
        height: 55px;
        min-width: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff3cd;
        color: #ff9800;
        font-size: 1.4rem;
    }

    .note-content h4 {
        margin-bottom: 8px;
        color: var(--text-dark);
        font-weight: 700;
    }

    .note-content p {
        margin: 0;
        color: #6c757d;
        line-height: 1.7;
    }

    .quiz-rules {
        background: #faf9ff;
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .quiz-rules h5 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 15px;
    }

    .quiz-rules ul {
        margin: 0;
        padding-left: 20px;
    }

    .quiz-rules li {
        margin-bottom: 10px;
        color: #495057;
    }

    .start-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        text-decoration: none;
        border-radius: 14px;
        padding: 14px 32px;
        font-weight: 600;
        transition: .3s;
    }

    .start-btn:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(124, 77, 255, .25);
    }

    .start-footer {
        text-align: center;
    }

    .private-section {
        background: #faf9ff;
        border: 1px solid rgba(124, 77, 255, .12);
        border-radius: 18px;
        padding: 30px;
        text-align: center;
    }

    .private-section h5 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 10px;
    }

    .private-section p {
        color: #6c757d;
        margin-bottom: 20px;
    }

    .private-form {
        max-width: 450px;
        margin: 0 auto;
    }

    .code-input-group {
        display: flex;
        gap: 12px;
    }

    .code-input {
        flex: 1;
        height: 55px;
        border: 2px solid #e9e4ff;
        border-radius: 14px;
        padding: 0 18px;
        font-size: 1rem;
        font-weight: 500;
        transition: .3s;
    }

    .code-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(124, 77, 255, .12);
    }

    .code-submit-btn {
        border: none;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        padding: 0 24px;
        border-radius: 14px;
        font-weight: 600;
        transition: .3s;
        white-space: nowrap;
    }

    .code-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(124, 77, 255, .25);
    }

    .private-badge {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        border-radius: 50%;
        background: #ede7ff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
    }

    @media (max-width: 576px) {
        .code-input-group {
            flex-direction: column;
        }

        .code-submit-btn {
            height: 55px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="participation-wrapper">
        <div class="start-card">

            <div class="note-box">
                <div class="note-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="note-content">
                    <h4>Before You Start</h4>
                    <p>
                        You can participate in this quiz only once.
                        Make sure you are ready and have enough time
                        to complete all questions before starting.
                    </p>
                </div>
            </div>

            <div class="quiz-rules">
                <h5>Quiz Rules</h5>
                <ul>
                    <li>Each question carries equal marks.</li>
                    <li>Once submitted, answers cannot be changed.</li>
                    <li>Your score will be calculated instantly.</li>
                    <li>You can attempt this quiz only one time.</li>
                </ul>
            </div>

            @if($quiz->is_public)
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            <div class="start-footer">
                <a
                    href="{{route('participate.quiz',['quizID'=>$quiz->id])}}"
                    class="start-btn">
                    <i class="bi bi-play-fill"></i>
                    Start Quiz
                </a>
            </div>
            @else
            <div class="private-section">
                <div class="private-badge">
                    <i class="bi bi-lock-fill"></i>
                </div>
                <h5>Private Quiz Access</h5>
                <p>
                    This quiz requires an access code from the creator.
                    Enter the code below to start participating.
                </p>
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                <form
                    method="GET"
                    action="{{ route('participate.quiz',['quizID'=>$quiz->id]) }}"
                    class="private-form">
                    @csrf
                    <div class="code-input-group">
                        <input
                            type="text"
                            name="access_code"
                            class="code-input"
                            placeholder="Enter quiz access code"
                            required>
                        <button type="submit" class="code-submit-btn">
                            <i class="bi bi-play-fill me-1"></i>
                            Start Quiz
                        </button>
                    </div>
                </form>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection