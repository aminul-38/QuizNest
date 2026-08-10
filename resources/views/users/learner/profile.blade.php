@extends('layouts.users-layout')

@push('css')
<style>
    :root {
        --results-primary: #7c4dff;
        --results-primary-dark: #6a3ef5;
        --results-text: #2d3436;
        --results-muted: #6c757d;
        --results-border: rgba(124, 77, 255, .10);
    }

    /* Quiz Activity */
    .participated-results-section {
        margin: 35px auto 45px;
    }

    /* Section Header */
    .participated-results-header {
        margin-bottom: 25px;
        text-align: center;
    }

    .participated-results-title {
        position: relative;
        display: inline-block;
        margin: 0;
        color: var(--results-text);
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: -.4px;
    }

    .participated-results-title::after {
        content: "";
        display: block;
        width: 42px;
        height: 3px;
        margin: 8px auto 0;
        border-radius: 10px;
        background: var(--results-primary);
    }

    .participated-results-subtitle {
        display: block;
        max-width: 600px;
        margin: 10px auto 0;
        color: var(--results-muted);
        font-size: .9rem;
        line-height: 1.6;
    }

    /* Results Card */
    .participated-results-card {
        overflow: hidden;
        background: #ffffff;
        border: 1px solid var(--results-border);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
    }

    /* Table Wrapper */
    .participated-results-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* Results Table */
    .participated-results-table {
        width: 100%;
        min-width: 850px;
        margin: 0;
        border-collapse: collapse;
    }

    /* Table Header */
    .participated-results-table thead {
        background: #faf9ff;
    }

    .participated-results-table th {
        padding: 15px 18px;
        color: #555;
        border-bottom: 1px solid var(--results-border);
        font-size: .78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        white-space: nowrap;
    }

    /* Table Body */
    .participated-results-table td {
        padding: 15px 18px;
        color: var(--results-text);
        border-bottom: 1px solid #f1eff8;
        font-size: .88rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    .participated-results-table tbody tr {
        transition: background-color .2s ease;
    }

    .participated-results-table tbody tr:hover {
        background: #fcfaff;
    }

    .participated-results-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* Number */
    .result-number {
        width: 55px;
        color: var(--results-muted) !important;
        font-weight: 600;
    }

    /* Quiz Title */
    .result-quiz-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--results-primary);
        text-decoration: none;
        font-weight: 600;
        transition: .2s;
    }

    .result-quiz-link i {
        font-size: .9rem;
    }

    .result-quiz-link:hover {
        color: var(--results-primary-dark);
        text-decoration: underline;
    }

    /* Result Values */

    .result-value {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .88rem;
        font-weight: 600;
    }


    /* Correct */

    .result-correct {
        color: #198754;
    }


    /* Wrong */

    .result-wrong {
        color: #dc3545;
    }


    /* Unanswered */

    .result-unanswered {
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .participated-results-section {
            margin-top: 25px;
        }

        .participated-results-title {
            font-size: 1.5rem;
        }

        .participated-results-subtitle {
            padding: 0 15px;
        }

        .participated-results-card {
            border-radius: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <section class="participated-results-section">

        <!-- Section Header -->
        <div class="participated-results-header">
            <h2 class="participated-results-title">
                Quiz Activity
            </h2>
            <span class="participated-results-subtitle">
                A look at the quizzes participated in and the results achieved.
            </span>
        </div>

        <!-- Results Card -->
        <div class="participated-results-card">
            <div class="participated-results-table-wrapper">
                <table class="participated-results-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Quiz Title</th>
                            <th>Total Questions</th>
                            <th>Correct Answers</th>
                            <th>Wrong Answers</th>
                            <th>Unanswered</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($results as $result)
                        <tr>
                            <td class="result-number">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <a
                                    @if(session('user_role')=="Learner" )
                                    href="{{ route('quiz.start',['quizID'=>$result->quiz->id]) }}"
                                    @else
                                    href="{{ route('quiz.view',['quizID'=>$result->quiz->id]) }}"
                                    @endif
                                    class="result-quiz-link">
                                    <i class="bi bi-journal-text"></i>
                                    {{ $result->quiz->title }}
                                </a>
                            </td>

                            <td>
                                {{ $result->quiz->number_of_question }}
                            </td>

                            <td>
                                <span class="result-value result-correct">
                                    <i class="bi bi-check-circle-fill"></i>
                                    {{ $result->gained_point }}
                                </span>
                            </td>

                            <td>
                                <span class="result-value result-wrong">
                                    <i class="bi bi-x-circle-fill"></i>
                                    {{ $result->wrong_answer }}
                                </span>
                            </td>

                            <td>
                                <span class="result-value result-unanswered">
                                    <i class="bi bi-dash-circle-fill"></i>
                                    {{
                                        $result->quiz->number_of_question
                                        - ($result->gained_point + $result->wrong_answer)
                                    }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection