@extends('layouts.profile-layout')

@section('title')
| Change Password
@endsection

@push('css')
<style>
    :root {
        --password-primary: #7c4dff;
        --password-primary-dark: #6a3ef5;
        --password-bg: #f5f3ff;
        --password-text: #2d3436;
        --password-muted: #6c757d;
        --password-border: #e9ecef;
    }

    /* Page Wrapper */
    .change-password-page {
        max-width: 950px;
        margin: 45px auto 70px;
    }

    /* Page Header */
    .change-password-header {
        position: relative;
        display: flex;
        align-items: center;
        gap: 18px;
        margin: 25px auto 25px;
        padding: 30px 35px;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        border-radius: 24px;
        color: white;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(124, 77, 255, .18);
    }

    .change-password-header::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        right: -60px;
        top: -80px;
    }

    .change-password-header::after {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .07);
        right: 100px;
        bottom: -65px;
    }

    .change-password-header-icon {
        position: relative;
        z-index: 1;
        width: 58px;
        height: 58px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .16);
        border-radius: 15px;
        font-size: 1.45rem;
    }

    .change-password-header-content {
        position: relative;
        z-index: 1;
    }

    .change-password-header h2 {
        margin: 0 0 3px;
        font-size: 1.65rem;
        font-weight: 700;
    }

    .change-password-header p {
        margin: 0;
        color: rgba(255, 255, 255, .85);
        font-size: .9rem;
    }

    /* Main Card */
    .change-password-card {
        margin: 0 auto;
        background: white;
        border-radius: 24px;
        padding: 35px;
        border: 1px solid rgba(124, 77, 255, .08);
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
    }

    /* change password success message */
    .password-success-message {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px 18px;
        margin-bottom: 25px;
        background: #f0fff7;
        border: 1px solid #b7efd0;
        border-radius: 15px;
    }

    .password-success-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #d8f8e7;
        color: #198754;
        border-radius: 11px;
        font-size: 1.05rem;
    }

    .password-success-message strong {
        display: block;
        margin-bottom: 2px;
        color: #146c43;
        font-size: .9rem;
    }

    .password-success-message p {
        margin: 0;
        color: #3d7659;
        font-size: .8rem;
        line-height: 1.5;
    }

    /* Form */
    .password-form-group {
        margin-bottom: 22px;
    }

    .password-form-label {
        display: block;
        margin-bottom: 8px;
        color: var(--password-text);
        font-size: .9rem;
        font-weight: 600;
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9a9a9a;
        font-size: 1rem;
        z-index: 2;
        pointer-events: none;
    }

    .password-input {
        width: 100%;
        height: 52px;
        padding: 0 48px 0 45px;
        border: 2px solid var(--password-border);
        border-radius: 14px;
        outline: none;
        color: var(--password-text);
        font-size: .92rem;
        background: white;
        transition: .25s ease;
    }

    .password-input::placeholder {
        color: #adb5bd;
    }

    .password-input:hover {
        border-color: #d8ccff;
    }

    .password-input:focus {
        border-color: var(--password-primary);
        box-shadow: 0 0 0 4px rgba(124, 77, 255, .10);
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #8c8c8c;
        padding: 5px;
        cursor: pointer;
        transition: .2s;
    }

    .password-toggle:hover {
        color: var(--password-primary);
    }

    /* Password Hint */
    .password-hint {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-top: 8px;
        color: var(--password-muted);
        font-size: .78rem;
        line-height: 1.5;
    }

    .password-hint i {
        color: var(--password-primary);
        margin-top: 2px;
    }

    /* Security Notice */
    .password-security-notice {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 18px;
        margin: 28px 0;
        background: #f8f5ff;
        border: 1px solid #ede7ff;
        border-radius: 15px;
    }

    .password-security-notice i {
        color: var(--password-primary);
        font-size: 1.15rem;
        margin-top: 2px;
    }

    .password-security-notice p {
        margin: 0;
        color: #5f6368;
        font-size: .82rem;
        line-height: 1.6;
    }

    .password-security-notice strong {
        color: var(--password-text);
    }

    /* Actions */
    .change-password-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 5px;
    }

    .btn-password-cancel,
    .btn-password-update {
        min-width: 145px;
        padding: 11px 22px;
        border-radius: 12px;
        font-size: .9rem;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: .25s ease;
    }

    .btn-password-cancel {
        background: white;
        color: var(--password-muted);
        border: 2px solid var(--password-border);
    }

    .btn-password-cancel:hover {
        background: #f8f9fa;
        color: var(--password-text);
        border-color: #d5d9dc;
    }

    .btn-password-update {
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        border: none;
        box-shadow: 0 5px 15px rgba(124, 77, 255, .18);
    }

    .btn-password-update:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124, 77, 255, .25);
    }

    /* Validation */
    .password-error {
        margin-top: 6px;
        color: #dc3545;
        font-size: .78rem;
    }

    .password-input.is-invalid {
        border-color: #dc3545;
    }

    /* Responsive */
    @media(max-width: 576px) {
        .change-password-page {
            margin: 30px auto 50px;
        }

        .change-password-header {
            padding: 24px;
            gap: 14px;
            border-radius: 20px;
        }

        .change-password-header-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }

        .change-password-header h2 {
            font-size: 1.35rem;
        }

        .change-password-header p {
            font-size: .8rem;
        }

        .change-password-card {
            padding: 25px 20px;
            border-radius: 20px;
        }

        .change-password-actions {
            flex-direction: column-reverse;
        }

        .btn-password-cancel,
        .btn-password-update {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="container change-password-page">

    {{-- Page Header --}}
    <div class="change-password-header">
        <div class="change-password-header-icon">
            <i class="bi bi-shield-lock"></i>
        </div>

        <div class="change-password-header-content">
            <h2>Change Password</h2>
            <p>
                Keep your QuizNest account secure with a strong password.
            </p>
        </div>
    </div>

    {{-- Change Password Card --}}
    <div class="change-password-card">
        @if(session('success'))
        <div class="password-success-message">
            <div class="password-success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <strong>Password Updated</strong>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <form
            action="{{ route('profile.password.update') }}"
            method="POST">
            @csrf

            {{-- Current Password --}}
            <div class="password-form-group">
                <label
                    for="current_password"
                    class="password-form-label">
                    Current Password
                </label>

                <div class="password-input-wrapper">
                    <i class="bi bi-lock password-input-icon"></i>

                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="password-input @error('current_password') is-invalid @enderror"
                        placeholder="Enter your current password"
                        autocomplete="current-password"
                        required>

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="current_password"
                        aria-label="Show password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                @error('current_password')
                <div class="password-error">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="password-form-group">
                <label
                    for="password"
                    class="password-form-label">
                    New Password
                </label>

                <div class="password-input-wrapper">
                    <i class="bi bi-key password-input-icon"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="password-input @error('password') is-invalid @enderror"
                        placeholder="Enter your new password"
                        autocomplete="new-password"
                        required>

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="password"
                        aria-label="Show password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <div class="password-hint">
                    <i class="bi bi-info-circle"></i>
                    <span>
                        Use a strong password that you don't use elsewhere.
                    </span>
                </div>

                @error('password')
                <div class="password-error">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="password-form-group">
                <label
                    for="password_confirmation"
                    class="password-form-label">
                    Confirm New Password
                </label>

                <div class="password-input-wrapper">
                    <i class="bi bi-check2-circle password-input-icon"></i>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="password-input"
                        placeholder="Re-enter your new password"
                        autocomplete="new-password"
                        required>

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="password_confirmation"
                        aria-label="Show password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            {{-- Security Notice --}}
            <div class="password-security-notice">
                <i class="bi bi-shield-check"></i>

                <p>
                    <strong>Stay secure.</strong>
                    Never share your QuizNest password with anyone.
                    QuizNest will never ask you to provide your password through
                    email or messages.
                </p>
            </div>

            {{-- Actions --}}
            <div class="change-password-actions">
                <a
                    href="{{ route('profile.show', [
                        'userID' => session('user_id'),
                        'userName' => session('user_name')
                    ]) }}"
                    class="btn-password-cancel">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn-password-update">
                    <i class="bi bi-shield-lock me-2"></i>
                    Update Password
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
                this.setAttribute('aria-label', 'Hide password');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
                this.setAttribute('aria-label', 'Show password');
            }
        });
    });
</script>
@endpush