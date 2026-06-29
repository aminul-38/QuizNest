@extends('layouts.participation-layout')

@section('title')
| Play Quiz
@endsection

@push('css')
<style>
    :root {
        --primary: #7c4dff;
        --primary-dark: #6a3ef5;
        --bg-light: #f5f3ff;
        --text-dark: #2d3436;
    }

    .quiz-wrapper {
        max-width: 900px;
        margin: 40px auto 80px;
    }

    .quiz-header {
        background: white;
        border-radius: 24px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        border: 1px solid rgba(124, 77, 255, .08);
    }

    .quiz-header h2 {
        margin: 0;
        font-weight: 700;
        color: var(--text-dark);
    }

    .quiz-header p {
        margin: 8px 0 0;
        color: #6c757d;
    }

    .question-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        border: 1px solid rgba(124, 77, 255, .08);
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
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .options-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .option-item {
        position: relative;
    }

    .option-input {
        display: none;
    }

    .option-label {
        display: flex;
        align-items: center;
        gap: 15px;
        width: 100%;
        cursor: pointer;
        background: #faf9ff;
        border: 2px solid transparent;
        border-radius: 16px;
        padding: 16px 20px;
        transition: .3s;
    }

    .option-label:hover {
        border-color: #d8c8ff;
        background: #f7f3ff;
    }

    .option-input:checked+.option-label {
        border-color: var(--primary);
        background: #ede7ff;
    }

    .option-circle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 2px solid #b197fc;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .option-input:checked+.option-label .option-circle::after {
        content: "";
        width: 10px;
        height: 10px;
        background: var(--primary);
        border-radius: 50%;
    }

    .submit-section {
        position: sticky;
        bottom: 20px;
        text-align: center;
        margin-top: 40px;
    }

    .submit-btn {
        border: none;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        font-weight: 600;
        padding: 15px 40px;
        border-radius: 16px;
        font-size: 1rem;
        transition: .3s;
        box-shadow: 0 10px 25px rgba(124, 77, 255, .25);
    }

    .submit-btn:hover {
        transform: translateY(-3px);
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="quiz-wrapper">
        <div class="quiz-header">
            <h2>{{ $quiz->title }}</h2>
            <p>
                Answer all questions and submit your quiz.
            </p>
        </div>

        <form
            method="POST"
            action="{{route('participation.submit',['quizID'=>$quiz->id])}}">
            @csrf
            @foreach($quiz->questions as $index => $question)
            <div class="question-card">
                <div class="question-number">
                    Question {{ $index + 1 }}
                </div>
                <div class=" question-title">
                    {{ $question->question_description }}
                </div>
                <div class="options-list">
                    @foreach($question->options as $option)
                    <div class="option-item">
                        <input
                            class="option-input"
                            type="radio"
                            name="answers[{{ $question->id }}]"
                            id="option_{{ $option->id }}"
                            value="{{ $option->id }}">
                        <label
                            class="option-label"
                            for="option_{{ $option->id }}">
                            <span class="option-circle"></span>
                            <span>
                                {{ $option->option_description }}
                            </span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="submit-section">
                <button type="submit" class="submit-btn">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Submit Quiz
                </button>
            </div>
        </form>
    </div>
</div>
@endsection