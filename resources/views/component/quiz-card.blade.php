<style>
    :root {
        --primary: #7c4dff;
        --primary-dark: #6a3ef5;
        --bg-light: #f5f3ff;
        --text-dark: #2d3436;
        --border: #e9ecef;
    }

    .quiz-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 24px;
        padding: 25px;
        margin-top: 20px;
        margin-bottom: 25px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
        transition: all .3s ease;
        border: 1px solid rgba(124, 77, 255, .08);
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
        grid-template-columns: repeat(4, 1fr);
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

    @media(max-width:768px) {
        .quiz-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>


<div class="container">
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
    </div>
</div>