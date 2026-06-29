@extends('layouts.view-quiz-layout')

@section('title')
| Results
@endsection

@push('css')
<style>
    :root {
        --primary: #7c4dff;
        --primary-light: #ede7ff;
        --text-dark: #2d3436;
    }

    .results-wrapper {
        margin: 40px auto 80px;
    }

    .results-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        border: 1px solid rgba(124, 77, 255, .08);
    }

    .results-header {
        text-align: center;
        padding: 25px 30px;
        border-bottom: 1px solid #f1f1f1;
        background: linear-gradient(135deg,
                #faf8ff,
                #ffffff);
    }

    .results-header h3 {
        margin: 0;
        color: var(--text-dark);
        font-weight: 700;
    }

    .results-header p {
        margin: 5px 0 0;
        color: #6c757d;
    }

    .results-table {
        margin: 0;
    }

    .results-table thead {
        background: #7c4dff !important;
    }

    .results-table thead th {
        background: #7c4dff !important;
        color: #ffffff !important;
        font-weight: 600;
        border: none !important;
        padding: 18px 24px;
    }

    .results-table tbody tr {
        transition: .25s;
    }

    .results-table tbody tr:hover {
        background: #faf8ff;
    }

    .results-table tbody td,
    .results-table tbody th {
        padding: 18px 24px;
        vertical-align: middle;
        border-color: #f3f3f3;
    }

    .rank-badge {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .participant-link {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .participant-name {
        color: var(--text-dark);
        font-weight: 600;
        transition: .25s;
    }

    .participant-link:hover .participant-name {
        color: var(--primary);
    }

    .score-badge {
        display: inline-block;
        padding: 8px 14px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 12px;
        font-weight: 700;
        min-width: 60px;
        text-align: center;
    }

    .submit-time {
        color: #6c757d;
        font-size: .95rem;
    }

    @media (max-width: 768px) {

        .results-table thead th,
        .results-table tbody td,
        .results-table tbody th {
            padding: 14px;
        }

        .results-header {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container results-wrapper">
    <div class="results-card">
        <div class="results-header">
            <h3>
                <i class="bi bi-trophy-fill me-2 text-warning"></i>
                Quiz Leaderboard
            </h3>
            <p>
                Participant rankings based on achieved scores
            </p>
        </div>

        <div class="table-responsive">
            <table class="table results-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Participant Name</th>
                        <th>Points</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($results as $result)
                    <tr>
                        <td>
                            <div class="rank-badge">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>
                            <a href="#" class="participant-link">
                                <span class="participant-name">
                                    {{ $result->participant->name }}
                                </span>
                            </a>
                        </td>
                        <td>
                            <span class="score-badge">
                                {{ $result->gained_point }}
                            </span>
                        </td>
                        <td>
                            <span class="submit-time">
                                {{ $result->created_at->format('d M Y • h:i A') }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection