@extends('layouts.profile-layout')

@section('title')
| Create Quiz
@endsection

@push('css')
<style>
    :root {
        --create-primary: #7c4dff;
        --create-primary-dark: #6a3ef5;
        --create-primary-light: #ede7ff;
        --create-bg: #f8f5ff;
        --create-text: #2d3436;
        --create-muted: #6c757d;
        --create-border: #e9ecef;
        --create-danger: #dc3545;
        --create-success: #198754;
    }

    /* Page */
    .create-quiz-page {
        max-width: 1000px;
        margin: 35px auto 60px;
    }

    /* Page Header*/
    .create-quiz-header {
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        padding: 30px 35px;
        border-radius: 24px;
        background: linear-gradient(135deg, #7c4dff, #9b6dff);
        box-shadow: 0 10px 30px rgba(124, 77, 255, .18);
        color: white;
    }

    .create-quiz-header::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -60px;
        top: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }

    .create-quiz-header::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        right: 100px;
        bottom: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
    }

    .create-quiz-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .create-quiz-header-icon {
        width: 58px;
        height: 58px;
        flex-shrink: 0;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        background: rgba(255, 255, 255, .16);
        color: white;
        font-size: 1.5rem;
        backdrop-filter: blur(5px);
    }

    .create-quiz-header h2 {
        margin: 0 0 5px;
        color: white;
        font-size: 1.6rem;
        font-weight: 700;
    }

    .create-quiz-header p {
        margin: 0;
        color: rgba(255, 255, 255, .82);
        font-size: .9rem;
    }

    /* Form Sections*/
    .quiz-form-section {
        background: #fff;
        border: 1px solid rgba(124, 77, 255, .08);
        border-radius: 24px;
        padding: 28px;
        margin-bottom: 25px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 25px;
    }

    .section-heading-icon {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--create-primary-light);
        color: var(--create-primary);
        border-radius: 13px;
        font-size: 1.2rem;
    }

    .section-heading-content h2 {
        margin: 0;
        color: var(--create-text);
        font-size: 1.15rem;
        font-weight: 700;
    }

    .section-heading-content p {
        margin: 3px 0 0;
        color: var(--create-muted);
        font-size: .82rem;
    }

    /* Form Controls */
    .quiz-form-label {
        display: block;
        margin-bottom: 8px;
        color: var(--create-text);
        font-size: .9rem;
        font-weight: 600;
    }

    .quiz-form-label .required {
        color: var(--create-danger);
    }

    .quiz-form-control,
    .quiz-form-select {
        width: 100%;
        min-height: 48px;
        padding: 11px 15px;
        border: 1px solid var(--create-border);
        border-radius: 12px;
        outline: none;
        background: #fff;
        color: var(--create-text);
        font-family: inherit;
        font-size: .9rem;
        transition: .25s ease;
    }

    .quiz-form-control::placeholder {
        color: #adb5bd;
    }

    .quiz-form-control:focus,
    .quiz-form-select:focus {
        border-color: var(--create-primary);
        box-shadow: 0 0 0 3px rgba(124, 77, 255, .1);
    }

    textarea.quiz-form-control {
        resize: vertical;
        min-height: 100px;
    }

    .field-help {
        margin-top: 6px;
        color: var(--create-muted);
        font-size: .75rem;
    }

    .invalid-feedback-custom {
        display: block;
        margin-top: 6px;
        color: var(--create-danger);
        font-size: .78rem;
    }

    .is-invalid {
        border-color: var(--create-danger) !important;
    }

    /* Private Code */
    .private-code-wrapper {
        display: none;
    }

    .private-code-wrapper.show {
        display: block;
    }

    /* Question Card */
    .question-card {
        position: relative;
        background: #faf9ff;
        border: 1px solid rgba(124, 77, 255, .1);
        border-radius: 20px;
        padding: 22px;
        margin-bottom: 20px;
    }

    .question-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .question-number-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .question-number {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--create-primary);
        color: #fff;
        border-radius: 11px;
        font-size: .9rem;
        font-weight: 700;
    }

    .question-label {
        margin: 0;
        color: var(--create-text);
        font-size: 1rem;
        font-weight: 700;
    }

    .remove-question-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #fff0f1;
        color: var(--create-danger);
        border-radius: 10px;
        transition: .25s ease;
    }

    .remove-question-btn:hover {
        background: var(--create-danger);
        color: #fff;
    }

    /* Options */
    .options-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 12px;
    }

    .options-title {
        margin: 0;
        color: var(--create-text);
        font-size: .88rem;
        font-weight: 600;
    }

    .options-help {
        color: var(--create-muted);
        font-size: .72rem;
    }

    .option-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .correct-option-radio {
        position: relative;
        width: 42px;
        height: 48px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid var(--create-border);
        border-radius: 12px;
        cursor: pointer;
        transition: .25s ease;
    }

    .correct-option-radio input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .radio-check {
        width: 17px;
        height: 17px;
        border: 2px solid #adb5bd;
        border-radius: 50%;
        transition: .2s ease;
    }

    .correct-option-radio:has(input:checked) {
        border-color: var(--create-success);
        background: #f0fff7;
    }

    .correct-option-radio:has(input:checked) .radio-check {
        border-color: var(--create-success);
        background: var(--create-success);
        box-shadow: inset 0 0 0 3px #fff;
    }

    .option-number {
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--create-primary-light);
        color: var(--create-primary);
        border-radius: 8px;
        font-size: .75rem;
        font-weight: 700;
    }

    .option-input {
        flex: 1;
        min-width: 0;
    }

    .correct-answer-hint {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 12px;
        color: var(--create-muted);
        font-size: .75rem;
    }

    .correct-answer-hint i {
        color: var(--create-success);
    }

    /* Add Question */
    .add-question-wrapper {
        text-align: center;
        padding-top: 5px;
    }

    .add-question-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        border: 2px dashed rgba(124, 77, 255, .35);
        border-radius: 12px;
        background: #fff;
        color: var(--create-primary);
        font-size: .85rem;
        font-weight: 600;
        transition: .25s ease;
    }

    .add-question-btn:hover {
        border-color: var(--create-primary);
        background: var(--create-primary-light);
    }

    /* Empty Question State */
    .question-empty-state {
        text-align: center;
        padding: 35px 20px;
        color: var(--create-muted);
    }

    .question-empty-state i {
        display: block;
        margin-bottom: 10px;
        color: var(--create-primary);
        font-size: 2rem;
    }

    .question-empty-state p {
        margin: 0;
        font-size: .85rem;
    }

    /* Form Actions */
    .quiz-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 5px;
    }

    .btn-cancel-quiz,
    .btn-create-quiz {
        min-width: 140px;
        padding: 12px 22px;
        border-radius: 12px;
        font-family: inherit;
        font-size: .88rem;
        font-weight: 600;
        text-decoration: none;
        transition: .25s ease;
    }

    .btn-cancel-quiz {
        border: 2px solid var(--create-border);
        background: #fff;
        color: var(--create-muted);
    }

    .btn-cancel-quiz:hover {
        background: #f8f9fa;
        color: var(--create-text);
    }

    .btn-create-quiz {
        border: none;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: #fff;
        box-shadow: 0 6px 18px rgba(124, 77, 255, .2);
    }

    .btn-create-quiz:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 9px 22px rgba(124, 77, 255, .3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .create-quiz-page {
            margin-top: 25px;
        }

        .quiz-form-section {
            padding: 20px;
            border-radius: 20px;
        }

        .create-quiz-title {
            font-size: 1.5rem;
        }

        .question-card {
            padding: 17px;
        }

        .question-card-header {
            align-items: flex-start;
        }

        .options-help {
            display: none;
        }

        .quiz-form-actions {
            flex-direction: column-reverse;
        }

        .btn-cancel-quiz,
        .btn-create-quiz {
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .create-quiz-header-icon {
            width: 55px;
            height: 55px;
            font-size: 1.5rem;
        }

        .option-row {
            gap: 7px;
        }

        .option-number {
            display: none;
        }

        .correct-option-radio {
            width: 38px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="create-quiz-page">

        {{-- Page Header --}}
        <div class="create-quiz-header">
            <div class="create-quiz-header-content">
                <div class="create-quiz-header-icon">
                    <i class="bi bi-journal-plus"></i>
                </div>
                <div>
                    <h2>Create a New Quiz</h2>
                    <p>
                        Build your quiz, add questions, and challenge the QuizNest community.
                    </p>
                </div>
            </div>
        </div>

        <form
            method="POST"
            action="#"
            id="createQuizForm">
            @csrf

            {{-- Quiz Information --}}
            <div class="quiz-form-section">
                <div class="section-heading">
                    <div class="section-heading-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="section-heading-content">
                        <h2>
                            Quiz Information
                        </h2>
                        <p>
                            Provide the basic information about your quiz.
                        </p>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Quiz Title --}}
                    <div class="col-12">
                        <label
                            for="quiz-title"
                            class="quiz-form-label">
                            Quiz Title
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="quiz-title"
                            name="title"
                            class="quiz-form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            placeholder="e.g. Laravel Fundamentals Quiz"
                            maxlength="150"
                            required>

                        @error('title')
                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6">
                        <label
                            for="category"
                            class="quiz-form-label">
                            Category
                            <span class="required">*</span>
                        </label>
                        <select
                            name="category_id"
                            id="category"
                            class="quiz-form-select @error('category_id') is-invalid @enderror"
                            required>
                            <option value="" selected disabled>
                                Select a category
                            </option>

                            {{-- Replace $categories with your actual category collection --}}
                            @foreach($categories ?? [] as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Subject --}}
                    <div class="col-md-6">
                        <label
                            for="subject"
                            class="quiz-form-label">
                            Subject
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            class="quiz-form-control @error('subject') is-invalid @enderror"
                            value="{{ old('subject') }}"
                            placeholder="e.g. Web Development"
                            maxlength="100"
                            required>

                        @error('subject')
                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Quiz Type --}}
                    <div class="col-md-6">
                        <label
                            for="quiz-type"
                            class="quiz-form-label">
                            Quiz Type
                            <span class="required">*</span>
                        </label>
                        <select
                            name="type"
                            id="quiz-type"
                            class="quiz-form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="" selected disabled>
                                Select quiz type
                            </option>
                            <option
                                value="public"
                                {{ old('type') === 'public' ? 'selected' : '' }}>
                                Public
                            </option>
                            <option
                                value="private"
                                {{ old('type') === 'private' ? 'selected' : '' }}>
                                Private
                            </option>
                        </select>
                        <div class="field-help">
                            Public quizzes can be discovered by everyone. Private quizzes require a code.
                        </div>

                        @error('type')
                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Private Code --}}
                    <div
                        class="col-md-6 private-code-wrapper"
                        id="private-code-wrapper">
                        <label
                            for="private-code"
                            class="quiz-form-label">
                            Private Code
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="private-code"
                            name="private_code"
                            class="quiz-form-control @error('private_code') is-invalid @enderror"
                            value="{{ old('private_code') }}"
                            placeholder="Enter a code participants will use"
                            maxlength="50">
                        <div class="field-help">
                            Share this code only with the participants you want to invite.
                        </div>

                        @error('private_code')
                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Questions --}}
            <div class="quiz-form-section">
                <div class="section-heading">
                    <div class="section-heading-icon">
                        <i class="bi bi-question-circle"></i>
                    </div>
                    <div class="section-heading-content">
                        <h2>
                            Quiz Questions
                        </h2>
                        <p>
                            Add questions and select the correct answer for each one.
                        </p>
                    </div>
                </div>

                <div id="questions-container">
                    {{-- First question --}}
                    <div
                        class="question-card"
                        data-question-index="0">
                        <div class="question-card-header">
                            <div class="question-number-wrapper">
                                <div class="question-number">
                                    1
                                </div>
                                <h3 class="question-label">
                                    Question 1
                                </h3>
                            </div>

                            <button
                                type="button"
                                class="remove-question-btn"
                                title="Remove question"
                                onclick="removeQuestion(this)">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>

                        {{-- Question Text --}}
                        <label class="quiz-form-label">
                            Question
                            <span class="required">*</span>
                        </label>

                        <textarea
                            name="questions[0][question]"
                            class="quiz-form-control"
                            placeholder="Enter your question here..."
                            maxlength="500"
                            required></textarea>

                        {{-- Options --}}
                        <div class="options-heading">
                            <h4 class="options-title">
                                Answer Options
                                <span class="required">*</span>
                            </h4>
                            <span class="options-help">
                                Select the radio button beside the correct answer
                            </span>
                        </div>

                        <div class="options-container">
                            {{-- Option 1 --}}
                            <div class="option-row">
                                <label class="correct-option-radio"
                                    title="Mark as correct answer">
                                    <input
                                        type="radio"
                                        name="questions[0][correct_option]"
                                        value="0"
                                        required>
                                    <span class="radio-check"></span>
                                </label>

                                <span class="option-number">
                                    A
                                </span>

                                <input
                                    type="text"
                                    name="questions[0][options][0]"
                                    class="quiz-form-control option-input"
                                    placeholder="Option A"
                                    maxlength="250"
                                    required>
                            </div>

                            {{-- Option 2 --}}
                            <div class="option-row">
                                <label class="correct-option-radio"
                                    title="Mark as correct answer">

                                    <input
                                        type="radio"
                                        name="questions[0][correct_option]"
                                        value="1">
                                    <span class="radio-check"></span>
                                </label>

                                <span class="option-number">
                                    B
                                </span>

                                <input
                                    type="text"
                                    name="questions[0][options][1]"
                                    class="quiz-form-control option-input"
                                    placeholder="Option B"
                                    maxlength="250"
                                    required>
                            </div>


                            {{-- Option 3 --}}
                            <div class="option-row">
                                <label class="correct-option-radio"
                                    title="Mark as correct answer">
                                    <input
                                        type="radio"
                                        name="questions[0][correct_option]"
                                        value="2">
                                    <span class="radio-check"></span>
                                </label>

                                <span class="option-number">
                                    C
                                </span>

                                <input
                                    type="text"
                                    name="questions[0][options][2]"
                                    class="quiz-form-control option-input"
                                    placeholder="Option C"
                                    maxlength="250"
                                    required>
                            </div>

                            {{-- Option 4 --}}
                            <div class="option-row">
                                <label class="correct-option-radio"
                                    title="Mark as correct answer">
                                    <input
                                        type="radio"
                                        name="questions[0][correct_option]"
                                        value="3">
                                    <span class="radio-check"></span>
                                </label>

                                <span class="option-number">
                                    D
                                </span>

                                <input
                                    type="text"
                                    name="questions[0][options][3]"
                                    class="quiz-form-control option-input"
                                    placeholder="Option D"
                                    maxlength="250"
                                    required>
                            </div>
                        </div>

                        <div class="correct-answer-hint">
                            <i class="bi bi-check-circle-fill"></i>
                            Select one option as the correct answer.
                        </div>
                    </div>
                </div>

                {{-- Add Question --}}
                <div class="add-question-wrapper">
                    <button
                        type="button"
                        class="add-question-btn"
                        id="add-question-btn">
                        <i class="bi bi-plus-lg"></i>
                        Add Question
                    </button>
                </div>
            </div>

            {{-- Actions --}}
            <div class="quiz-form-actions">
                <a
                    href="{{ url()->previous() }}"
                    class="btn-cancel-quiz">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn-create-quiz">
                    <i class="bi bi-check2-circle me-2"></i>
                    Create Quiz
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let questionIndex = 1;

    /* Private Quiz Code */
    const quizType = document.getElementById('quiz-type');
    const privateCodeWrapper = document.getElementById('private-code-wrapper');
    const privateCodeInput = document.getElementById('private-code');

    function handleQuizType() {
        if (quizType.value === 'private') {
            privateCodeWrapper.classList.add('show');
            privateCodeInput.required = true;
        } else {
            privateCodeWrapper.classList.remove('show');
            privateCodeInput.required = false;
            privateCodeInput.value = '';
        }
    }

    quizType.addEventListener('change', handleQuizType);
    // Preserve private-code state after validation error.
    handleQuizType();

    /* Add Question */
    document.getElementById('add-question-btn').addEventListener('click', function() {
        addQuestion();
    });

    function addQuestion() {
        const container = document.getElementById('questions-container');
        const index = questionIndex;
        const questionCard = document.createElement('div');

        questionCard.className = 'question-card';
        questionCard.dataset.questionIndex = index;
        questionCard.innerHTML = `
            <div class="question-card-header">
                <div class="question-number-wrapper">
                    <div class="question-number">
                        ${index + 1}
                    </div>
                    <h3 class="question-label">
                        Question ${index + 1}
                    </h3>
                </div>

                <button
                    type="button"
                    class="remove-question-btn"
                    title="Remove question"
                    onclick="removeQuestion(this)">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>

            <label class="quiz-form-label">
                Question
                <span class="required">*</span>
            </label>

            <textarea
                name="questions[${index}][question]"
                class="quiz-form-control"
                placeholder="Enter your question here..."
                maxlength="500"
                required></textarea>

            <div class="options-heading">
                <h4 class="options-title">
                    Answer Options
                    <span class="required">*</span>
                </h4>

                <span class="options-help">
                    Select the radio button beside the correct answer
                </span>
            </div>

            <div class="options-container">
                ${createOption(index, 0, 'A', true)}
                ${createOption(index, 1, 'B', true)}
                ${createOption(index, 2, 'C', false)}
                ${createOption(index, 3, 'D', false)}
            </div>

            <div class="correct-answer-hint">
                <i class="bi bi-check-circle-fill"></i>
                Select one option as the correct answer.
            </div>
        `;

        container.appendChild(questionCard);
        questionIndex++;
        updateQuestionNumbers();

        questionCard.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    /* Create Option */
    function createOption(questionIndex, optionIndex, letter, required) {
        return `
            <div class="option-row">
                <label
                    class="correct-option-radio"
                    title="Mark as correct answer">
                    <input
                        type="radio"
                        name="questions[${questionIndex}][correct_option]"
                        value="${optionIndex}"
                        ${required ? 'required' : ''}>
                    <span class="radio-check"></span>
                </label>

                <span class="option-number">
                    ${letter}
                </span>

                <input
                    type="text"
                    name="questions[${questionIndex}][options][${optionIndex}]"
                    class="quiz-form-control option-input"
                    placeholder="Option ${letter}"
                    maxlength="250"
                    required>
            </div>
        `;
    }

    /* Remove Question */
    function removeQuestion(button) {
        const container = document.getElementById('questions-container');
        const questionCards = container.querySelectorAll('.question-card');

        /* Always keep at least one question. */
        if (questionCards.length <= 1) {
            alert('A quiz must contain at least one question.');
            return;
        }

        const questionCard = button.closest('.question-card');

        questionCard.remove();
        updateQuestionNumbers();
    }

    /* Update Question Numbers */
    function updateQuestionNumbers() {
        const questionCards = document.querySelectorAll('.question-card');

        questionCards.forEach((card, displayIndex) => {
            card.querySelector('.question-number').textContent = displayIndex + 1;
            card.querySelector('.question-label').textContent = `Question ${displayIndex + 1}`;
        });
    }

    /* Form Validation */
    document.getElementById('createQuizForm').addEventListener('submit', function(event) {
        const questionCards = document.querySelectorAll('.question-card');
        let isValid = true;

        questionCards.forEach(card => {
            const correctOption = card.querySelector('input[type="radio"]:checked');

            /* Every question must have exactly one correct answer. */
            if (!correctOption) {
                isValid = false;
                alert(
                    'Please select the correct answer for every question.'
                );
                return;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    /* Initial State */
    updateQuestionNumbers();
</script>
@endpush