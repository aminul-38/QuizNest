@extends('layouts.auth-layout')

@section('title')
| Login
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
        box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
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

    .login-card {
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
        right: 20px;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        cursor: pointer;
        font-size: 1rem;
        padding: 0;
    }

    .btn-login {
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

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 25px rgba(124, 58, 237, .25);
    }

    .registration-link {
        text-align: center;
        margin-top: 20px;
    }

    .registration-link a {
        color: #7c3aed;
        font-weight: 600;
        text-decoration: none;
    }

    .registration-link a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="hero-section text-center">
        <h1 class="main-heading">Welcome Back!</h1>
        <p class="subtitle">
            Pick up where you left off and continue learning, creating, and growing with QuizNest.
        </p>
    </div>
    <div class="row g-4 align-items-center">
        <div class="col-lg-5">
            <div class="feature-wrapper">
                <div class="feature-card">
                    <img class="ill-icon" src="https://img.icons8.com/nolan/64/resume-button.png" alt="resume-button" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Resume Quizzes
                        </h6>
                        <small class="text-muted">
                            Continue from where you last stopped.
                        </small>
                    </div>
                </div>
                <div class="feature-card">
                    <img class="ill-icon" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/external-result-marketing-agency-flaticons-lineal-color-flat-icons-3.png" alt="external-result-marketing-agency-flaticons-lineal-color-flat-icons-3" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Track Progress
                        </h6>
                        <small class="text-muted">
                            View your achievements and performance.
                        </small>
                    </div>
                </div>
                <div class="feature-card">
                    <img class="ill-icon" src="https://img.icons8.com/plasticine/100/document.png" alt="document" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Manage Content
                        </h6>
                        <small class="text-muted">
                            Organize and update your quizzes.
                        </small>
                    </div>
                </div>
                <div class="feature-card">
                    <img class="ill-icon" src="https://img.icons8.com/external-parzival-1997-flat-parzival-1997/64/external-brainstorming-organization-management-parzival-1997-flat-parzival-1997.png" alt="external-brainstorming-organization-management-parzival-1997-flat-parzival-1997" />
                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Explore Challenges
                        </h6>
                        <small class="text-muted">
                            Discover new quizzes and learning opportunities.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="login-card">
                <h2 class="form-title">Sign In</h2>
                <p class="form-subtitle">Enter your credentials to continue.</p>
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                <form method="POST" action="{{route('auth.login.attempt')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
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
                        <div class="col-12">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <div class="password-wrapper">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password">
                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password', this)">
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
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button
                                type="submit"
                                class="btn-login">
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>
                <div class="registration-link">
                    Don't have an account?
                    <a href="{{route('auth.registration')}}">
                        Create one now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputFieldId, button) {
        // console.log(inputFieldId);
        // console.log(button);
        const input = document.getElementById(inputFieldId);
        const icon = button.querySelector('i');

        if (input.type == "password") {
            input.type = "text";
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endpush