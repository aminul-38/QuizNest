@extends('layouts.view-quiz-layout')

@section('title')
| Quiz View
@endsection

@push('css')
<style>
    .quiz-wrapper {
        max-width: 1000px;
        margin: 40px auto 80px;
    }

    .question-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
        border: 1px solid rgba(124, 77, 255, .08);
        box-shadow: 0 8px 25px rgba(124, 77, 255, .08);
    }

    .question-number {
        display: inline-block;
        background: #ede7ff;
        color: var(--primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .question-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .options-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px 30px;
    }

    .option-item {
        padding: 14px 18px;
        background: #faf9ff;
        border-radius: 12px;
        border: 1px solid #f0ebff;
        font-size: 1rem;
    }

    /* Correct Answer */
    .option-correct {
        color: #198754;
        font-weight: 700;
        background: #ecfdf3;
        border-color: #b7ebc9;
    }

    .option-correct::after {
        content: " ✓";
    }

    /* button section */
    .action-section {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 35px;
    }

    .btn-home,
    .btn-leaderboard {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: all .3s ease;
    }

    /* Home Button */
    .btn-home {
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-home:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Leaderboard Button */
    .btn-leaderboard {
        background: linear-gradient(135deg, #7c4dff, #9b6dff);
        color: white;
    }

    .btn-leaderboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(124, 77, 255, .25);
    }

    /* Mobile */
    @media (max-width: 768px) {
        .options-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .action-section {
            flex-direction: column;
        }

        .btn-home,
        .btn-leaderboard {
            justify-content: center;
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="quiz-wrapper">

        @foreach($quiz->questions as $index => $question)
        <div class="question-card">
            <div class="question-number">
                Question {{ $index + 1 }}
            </div>

            <div class="question-title">
                {{ $question->question_description }}
            </div>

            <div class="options-grid">
                @foreach($question->options as $option)
                <div class="option-item {{ $option->is_correct ? 'option-correct' : '' }}">
                    {{ $loop->iteration }}.
                    {{ $option->option_description }}
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <!-- Action Buttons -->
        <div class="action-section">
            <a href="{{ route('home') }}" class="btn-home">
                <i class="bi bi-house-door-fill"></i>
                Back to Home
            </a>

            <a href="{{ route('leaderboard.quiz', ['quizID' => $quiz->id]) }}"
                class="btn-leaderboard">
                <i class="bi bi-trophy-fill"></i>
                View Leaderboard
            </a>
        </div>

    </div>
</div>
@endsection