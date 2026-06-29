@extends('layouts.auth-layout')

@section('title')
| Registration
@endsection

@push('css')
<style>
    .hero-section {
        margin-bottom: 35px !important;
    }

    .main-heading {
        font-size: 2.8rem;
        font-weight: 700;
        color: #1e293b;
    }

    .subtitle {
        font-size: 1.1rem;
        color: #64748b;
    }

    .feature-wrapper {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .feature-card {
        display: flex;
        align-items: center;
        gap: 15px;
        background: white;
        padding: 18px 20px;
        border-radius: 15px;
        box-shadow:
            0 4px 15px rgba(0, 0, 0, .08);
        transition: .3s;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 10px 25px rgba(0, 0, 0, .12);
    }

    .ill-icon {
        width: 45px;
        height: 45px;
    }

    .registration-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow:
            0 15px 40px rgba(124, 58, 237, .12);
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .form-subtitle {
        color: #64748b;
        margin-bottom: 30px;
    }

    .stats-section {
        margin-top: 35px;
        padding: 20px;
        border-radius: 25px;
        background:
            linear-gradient(135deg,
                #7c3aed,
                #9333ea);
    }

    .stats-card {
        background: rgba(255, 255, 255, .18);
        backdrop-filter: blur(8px);
        color: white;
        border-radius: 15px;
        padding-top: 15px;
        transition: .3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow:
            0 10px 25px rgba(0, 0, 0, .12);
    }

    .stats-card h2 {
        color: white;
        font-weight: bold;
    }

    .stats-card p {
        color: rgba(255, 255, 255, .8);
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        display: block;
    }

    .form-control,
    .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 15px;
        min-height: 48px;
        transition: all .3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, .15);
        outline: none;
    }

    .form-text {
        font-size: .85rem;
        color: #64748b;
    }

    .form-check {
        margin-top: 15px;
    }

    .form-check-label {
        color: #334155;
        font-size: .95rem;
    }

    .password-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        cursor: pointer;
        font-size: 1rem;
        padding: 0;
    }

    .btn-register {
        width: 100%;
        background: linear-gradient(135deg,
                #7c3aed,
                #9333ea);
        border: none;
        color: white;
        padding: 14px;
        border-radius: 12px;
        font-weight: 600;
        margin-top: 20px;
        transition: .3s;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 25px rgba(124, 58, 237, .25);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
    }

    .login-link a {
        color: #7c3aed;
        font-weight: 600;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="hero-section text-center mb-5">
        <h1 class="main-heading">Welcome to QuizNest</h1>
        <p class="subtitle">Learn • Compete • Improve</p>
    </div>
    <div class="row g-4 align-items-center">
        <div class="col-lg-5">
            <div class="feature-wrapper">
                <div class="feature-card">
                    <img class="ill-icon"
                        src="https://img.icons8.com/emoji/48/trophy-emoji.png"
                        alt="trophy-emoji" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Earn Points
                        </h6>
                        <small class="text-muted">
                            Gain rewards and achievements as you complete quizzes.
                        </small>
                    </div>
                </div>
                <div class="feature-card">
                    <img class="ill-icon"
                        src="https://img.icons8.com/emoji/48/books-emoji.png"
                        alt="books-emoji" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Learn New Topics
                        </h6>
                        <small class="text-muted">
                            Expand your knowledge through engaging quizzes and challenges.
                        </small>
                    </div>
                </div>
                <div class="feature-card">
                    <img class="ill-icon"
                        src="https://img.icons8.com/cotton/64/graph--v1.png"
                        alt="graph--v1" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Track Progress
                        </h6>
                        <small class="text-muted">
                            Monitor your performance and celebrate your improvement.
                        </small>
                    </div>
                </div>
                <div class="feature-card">
                    <img class="ill-icon"
                        src="https://img.icons8.com/fluency/48/goal--v1.png"
                        alt="goal--v1" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Compete With Others
                        </h6>
                        <small class="text-muted">
                            Challenge yourself and compare results with fellow learners.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="registration-card">
                <h2 class="form-title">
                    Create Your Account
                </h2>
                <p class="form-subtitle">
                    Join thousands of learners and start your journey today.
                </p>
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                <form method="POST"
                    action="{{route('auth.registration.submit')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">
                                Full Name
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Enter your full name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Email Address
                            </label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="example@email.com">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                Phone Number (Optional)
                            </label>
                            <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                placeholder="01XXXXXXXXX">
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">
                                Account Type
                            </label>
                            <select
                                class="form-select"
                                id="role"
                                name="role">
                                <option selected disabled>
                                    Select your role
                                </option>
                                <option value="creator">
                                    Creator
                                </option>
                                <option value="learner">
                                    Learner
                                </option>
                            </select>
                            <div class="form-text">
                                Creator can publish quizzes, Learner can participate.
                            </div>
                        </div>
                        <div class="col-12">
                            <label
                                for="profile_picture"
                                class="form-label">
                                Profile Picture (Optional)
                            </label>
                            <input
                                type="file"
                                class="form-control"
                                id="profile_picture"
                                name="profile_picture">
                            <div class="form-text">
                                JPG, JPEG or PNG up to 2 MB.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <div class="password-wrapper">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Create a password">
                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label
                                for="password_confirmation"
                                class="form-label">
                                Confirm Password
                            </label>
                            <div class="password-wrapper">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Re-enter password">
                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="terms"
                                    name="terms"
                                    checked>
                                <label
                                    class="form-check-label"
                                    for="terms">
                                    I agree to the Terms & Conditions
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button
                                type="submit"
                                class="btn-register">
                                Create Account
                            </button>
                        </div>
                    </div>
                </form>
                <div class="login-link">
                    Already have an account?
                    <a href="{{route('auth.login')}}">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="stats-section">
        <div class="row justify-content-around g-4">
            <div class="col-md-3 stats-card text-center">
                <h2>10K+</h2>
                <p>Quizzes</p>
            </div>
            <div class="col-md-3 stats-card text-center">
                <h2>5K+</h2>
                <p>Learners</p>
            </div>
            <div class="col-md-3 stats-card text-center">
                <h2>50+</h2>
                <p>Categories</p>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(fieldId, button) {

        const input = document.getElementById(fieldId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endpush