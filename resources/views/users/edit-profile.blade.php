@extends('layouts.profile-layout')

@section('title')
| Edit Profile
@endsection

@push('css')
<style>
    :root {
        --profile-primary: #7c4dff;
        --profile-primary-dark: #6a3ef5;
        --profile-light: #f5f3ff;
        --profile-soft: #faf9ff;
        --profile-text: #2d3436;
        --profile-muted: #6c757d;
        --profile-border: #e9ecef;
    }

    .edit-profile-wrapper {
        max-width: 950px;
        margin: 45px auto 70px;
    }

    /* Page Header */
    .edit-profile-header {
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        padding: 30px 35px;
        border-radius: 24px;
        background: linear-gradient(135deg, #7c4dff, #9b6dff);
        box-shadow: 0 10px 30px rgba(124, 77, 255, .18);
        color: white;
    }

    .edit-profile-header::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -60px;
        top: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }

    .edit-profile-header::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        right: 100px;
        bottom: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
    }

    .edit-profile-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .edit-profile-header-icon {
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

    .edit-profile-header h2 {
        margin: 0 0 5px;
        color: white;
        font-size: 1.6rem;
        font-weight: 700;
    }

    .edit-profile-header p {
        margin: 0;
        color: rgba(255, 255, 255, .82);
        font-size: .9rem;
    }

    /* Main Card */
    .edit-profile-card {
        background: white;
        border: 1px solid rgba(124, 77, 255, .08);
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 8px 30px rgba(124, 77, 255, .08);
    }

    /* Profile Picture */
    .profile-picture-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 5px 10px 30px;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--profile-border);
    }

    .profile-picture-wrapper {
        position: relative;
        width: 125px;
        height: 125px;
        margin-bottom: 18px;
    }

    .profile-picture-preview {
        width: 125px;
        height: 125px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid white;
        outline: 3px solid #ede7ff;
        box-shadow: 0 8px 25px rgba(124, 77, 255, .15);
    }

    .profile-picture-upload {
        position: absolute;
        right: 2px;
        bottom: 2px;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        border-radius: 50%;
        background: var(--profile-primary);
        color: white;
        cursor: pointer;
        transition: .25s ease;
        box-shadow: 0 5px 15px rgba(124, 77, 255, .25);
    }

    .profile-picture-upload:hover {
        background: var(--profile-primary-dark);
        transform: scale(1.08);
    }

    .profile-picture-upload i {
        font-size: .95rem;
    }

    #profile_picture {
        display: none;
    }

    .profile-picture-title {
        margin: 0 0 5px;
        color: var(--profile-text);
        font-size: 1rem;
        font-weight: 600;
    }

    .profile-picture-hint {
        margin: 0;
        color: var(--profile-muted);
        font-size: .82rem;
    }

    /* Form */
    .profile-form-section {
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        margin-bottom: 9px;
        color: var(--profile-text);
        font-size: .92rem;
        font-weight: 600;
    }

    .form-label i {
        margin-right: 6px;
        color: var(--profile-primary);
    }

    .profile-input {
        width: 100%;
        padding: 13px 16px;
        border: 1px solid var(--profile-border);
        border-radius: 13px;
        background: #fff;
        color: var(--profile-text);
        font-size: .92rem;
        outline: none;
        transition: .25s ease;
    }

    .profile-input::placeholder {
        color: #adb5bd;
    }

    .profile-input:hover {
        border-color: #d7caff;
    }

    .profile-input:focus {
        border-color: var(--profile-primary);
        box-shadow: 0 0 0 4px rgba(124, 77, 255, .10);
    }

    .input-hint {
        display: block;
        margin-top: 7px;
        color: var(--profile-muted);
        font-size: .78rem;
    }

    /* Error */
    .profile-input.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: .8rem;
    }

    /* Actions */
    .profile-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
        padding-top: 25px;
        border-top: 1px solid var(--profile-border);
    }

    .btn-profile {
        min-width: 125px;
        padding: 11px 20px;
        border-radius: 12px;
        font-size: .9rem;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: .25s ease;
    }

    .btn-cancel {
        border: 2px solid var(--profile-border);
        background: white;
        color: var(--profile-muted);
    }

    .btn-cancel:hover {
        border-color: #d7caff;
        background: var(--profile-soft);
        color: var(--profile-text);
    }

    .btn-save {
        border: none;
        background: linear-gradient(135deg,
                #7c4dff,
                #9b6dff);
        color: white;
        box-shadow: 0 5px 15px rgba(124, 77, 255, .18);
    }

    .btn-save:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124, 77, 255, .25);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-profile-wrapper {
            margin: 30px auto 50px;
        }

        .edit-profile-card {
            padding: 25px 20px;
            border-radius: 20px;
        }

        .edit-profile-header h2 {
            font-size: 1.5rem;
        }

        .profile-actions {
            flex-direction: column-reverse;
        }

        .btn-profile {
            width: 100%;
        }
    }

    @media (max-width: 576px) {

        .profile-picture-wrapper,
        .profile-picture-preview {
            width: 110px;
            height: 110px;
        }

        .edit-profile-card {
            padding: 22px 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="edit-profile-wrapper">
        {{-- Page Header --}}
        <div class="edit-profile-header">
            <div class="edit-profile-header-content">
                <div class="edit-profile-header-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
                <div>
                    <h2>Edit Profile</h2>
                    <p>
                        Keep your QuizNest profile information up to date.
                    </p>
                </div>
            </div>
        </div>

        {{-- Edit Profile Card --}}
        <div class="edit-profile-card">

            <form
                action="{{ route('profile.update') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf

                {{-- Profile Picture --}}
                <div class="profile-picture-section">
                    <div class="profile-picture-wrapper">
                        <img
                            id="profilePicturePreview"
                            src="{{ asset($user->profile_img_path) }}"
                            alt="Profile Picture"
                            class="profile-picture-preview">
                        <label
                            for="profile_picture"
                            class="profile-picture-upload"
                            title="Change profile picture">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input
                            type="file"
                            id="profile_picture"
                            name="profile_picture"
                            accept="image/png,image/jpeg,image/jpg,image/webp">
                    </div>

                    <p class="profile-picture-title">
                        Profile Picture
                    </p>
                    <p class="profile-picture-hint">
                        JPG, PNG or WEBP • Maximum 2MB
                    </p>

                    @error('profile_picture')
                    <div class="text-danger mt-2 small">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Form Fields --}}
                <div class="profile-form-section">
                    {{-- Name --}}
                    <div class="form-group">
                        <label
                            for="name"
                            class="form-label">
                            <i class="bi bi-person"></i>
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="profile-input @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Enter your full name"
                            required>
                        @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Phone --}}
                    <div class="form-group">
                        <label
                            for="phone"
                            class="form-label">
                            <i class="bi bi-telephone"></i>
                            Phone Number
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="profile-input @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}"
                            placeholder="Enter your phone number">
                        <span class="input-hint">
                            Your phone number will be kept private and used only for account-related purposes.
                        </span>
                        @error('phone')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="profile-actions">
                        <a
                            href="{{ route('profile.show', [
                                'userID' => $user->id ?? session('user_id'),
                                'userName' => $user->name ?? session('user_name')
                            ]) }}"
                            class="btn-profile btn-cancel">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn-profile btn-save">
                            <i class="bi bi-check2-circle me-1"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document
        .getElementById('profile_picture')
        .addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }
            const preview = document.getElementById('profilePicturePreview');
            preview.src = URL.createObjectURL(file);
        });
</script>
@endpush