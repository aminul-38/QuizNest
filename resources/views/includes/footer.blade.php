<style>
    .quiznest-footer {
        background: #212529;
        color: #dee2e6;
        padding: 70px 0 40px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
        gap: 50px;
    }

    .footer-brand p {
        margin-top: 20px;
        line-height: 1.8;
        max-width: 300px;
        color: #adb5bd;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .footer-logo img {
        width: 48px;
        height: 48px;
    }

    .footer-logo span {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
    }

    .quiznest-footer h5 {
        color: white;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .quiznest-footer a {
        display: block;
        text-decoration: none;
        color: #adb5bd;
        margin-bottom: 12px;
        transition: .3s;
    }

    .quiznest-footer a:hover {
        color: #8f5cff;
        transform: translateX(4px);
    }

    .footer-brand small {
        display: block;
        margin-top: 20px;
        color: #6c757d;
    }

    .social-links {
        margin-top: 20px;
        display: flex;
        gap: 15px;
    }

    .social-links a {
        font-size: 1.3rem;
        color: #adb5bd;
    }

    .social-links a:hover {
        color: #8f5cff;
        transform: translateY(-2px);
    }

    .developer-credit {
        margin-top: 5px;
        color: #6c757d;
    }

    .developer-credit a {
        display: inline;
        color: #8f5cff;
        text-decoration: none;
    }

    @media (max-width: 992px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<footer class="quiznest-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <span>QuizNest</span>
                </div>
                <p>
                    Learn, challenge yourself, and compete with
                    players around the world through engaging quizzes.
                </p>
                <small>
                    © {{ date('Y') }} QuizNest. All rights reserved.
                </small>
                <small class="developer-credit">
                    Developed by |
                    <a href="https://www.linkedin.com/in/aminul38/" target="_blank">Aminul Imam</a>
                </small>
            </div>
            <div>
                <h5>Explore</h5>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}">Open Quizzes</a>
                <a href="{{ route('quiz.type',['quizType'=>'private']) }}">private Quizzes</a>
            </div>
            <div>
                <h5>Categories</h5>
                <a href="#">Programming</a>
                <a href="#">Science</a>
                <a href="#">History</a>
                <a href="#">Sports</a>
            </div>
            <div>
                <h5>Resources</h5>
                <a href="#">About QuizNest</a>
                <a href="#">FAQ</a>
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
            </div>
            <div>
                <h5>Community</h5>
                <a href="#">Leaderboard</a>
                <a href="#">Contact</a>
                <a href="#">Feedback</a>
                <a href="#">Support</a>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-discord"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>