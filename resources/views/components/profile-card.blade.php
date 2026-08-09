<style>
    :root {
        --profile-primary: #7c4dff;
        --profile-primary-dark: #6a3ef5;
        --profile-primary-light: #f5f3ff;
        --profile-text: #2d3436;
        --profile-muted: #6c757d;
        --profile-border: rgba(124, 77, 255, .10);
    }

    /* Profile Card */
    .profile-card {
        /* max-width: 850px; */
        margin: 40px auto;
        background: #ffffff;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid var(--profile-border);
        box-shadow: 0 10px 35px rgba(124, 77, 255, .10);
    }


    /* Profile Header */
    .profile-header {
        position: relative;
        padding: 45px 30px 35px;
        text-align: center;
        background:
            linear-gradient(135deg,
                #f5f3ff 0%,
                #ffffff 50%,
                #f8f5ff 100%);
    }

    .profile-header::before {
        content: "";
        position: absolute;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        width: 300px;
        height: 180px;
        background: rgba(124, 77, 255, .08);
        border-radius: 50%;
        filter: blur(10px);
    }


    /* Profile Picture */
    .profile-picture {
        position: relative;
        display: flex;
        justify-content: center;
        margin-bottom: 18px;
    }

    .profile-picture::before {
        content: "";
        position: absolute;
        width: 116px;
        height: 116px;
        border-radius: 50%;
        background: linear-gradient(135deg,
                var(--profile-primary),
                #a47cff);
        z-index: 0;
    }

    .profile-picture img {
        position: relative;
        z-index: 1;
        width: 105px;
        height: 105px;
        padding: 4px;
        border-radius: 50%;
        object-fit: cover;
        background: #ffffff;
        box-shadow: 0 8px 25px rgba(124, 77, 255, .20);
    }


    /* User Information */
    .profile-info {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .profile-name {
        margin: 0;
        color: var(--profile-text);
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -.5px;
    }

    .profile-role {
        display: inline-block;
        margin: 7px 0 12px;
        padding: 5px 14px;
        border-radius: 50px;
        background: #ede7ff;
        color: var(--profile-primary);
        font-size: .85rem;
        font-weight: 600;
    }

    .profile-email {
        margin: 0;
        color: var(--profile-muted);
        font-size: .95rem;
    }


    /* Profile Stats */
    .profile-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        max-width: 500px;
        margin: 22px auto 0;
    }

    .profile-stat-box {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 12px 18px;
        background: rgba(255, 255, 255, .85);
        border: 1px solid var(--profile-border);
        border-radius: 15px;
        text-align: left;
        transition: all .3s ease;
    }

    .profile-stat-box:hover {
        transform: translateY(-2px);
        border-color: rgba(124, 77, 255, .20);
        box-shadow: 0 6px 20px rgba(124, 77, 255, .10);
    }

    .profile-stat-icon {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #ede7ff;
        color: var(--profile-primary);
        font-size: 1rem;
    }

    .profile-stat-content {
        min-width: 0;
    }

    .profile-stat-box h5 {
        margin: 0;
        color: var(--profile-primary);
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .profile-stat-box span {
        display: block;
        margin-top: 2px;
        color: var(--profile-muted);
        font-size: .78rem;
        font-weight: 500;
    }


    /* Bottom Accent */
    .profile-card-accent {
        height: 5px;
        background: linear-gradient(90deg,
                #7c4dff,
                #9b6dff,
                #7c4dff);
    }


    /* Responsive */
    @media (max-width: 576px) {
        .quiznest-profile-card {
            margin: 25px 15px;
            border-radius: 22px;
        }

        .profile-header {
            padding: 35px 20px 28px;
        }

        .profile-name {
            font-size: 1.7rem;
        }

        .profile-stats {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .profile-stat-box {
            padding: 15px;
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .profile-stats {
            grid-template-columns: 1fr;
            max-width: 300px;
            gap: 10px;
        }

        .profile-stat-box {
            padding: 11px 15px;
        }
    }
</style>


<div class="container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-picture">
                <img
                    src="{{ asset($user->profile_img_path) }}"
                    alt="Profile Picture">
            </div>

            <div class="profile-info">
                <h1 class="profile-name">
                    {{ $user->name }}
                </h1>
                <span class="profile-role">
                    {{ $user->role }}
                </span>
                <p class="profile-email">
                    <i class="bi bi-envelope me-1"></i>
                    {{ $user->email }}
                </p>
            </div>

            <div class="profile-stats">
                <div class="profile-stat-box">
                    <div class="profile-stat-icon">
                        <i class="bi bi-patch-question-fill"></i>
                    </div>
                    <div class="profile-stat-content">
                        <h5>
                            10
                        </h5>
                        <span>
                            Quiz Participated
                        </span>
                    </div>
                </div>
                <div class="profile-stat-box">
                    <div class="profile-stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div class="profile-stat-content">
                        <h5>
                            100
                        </h5>
                        <span>
                            Total Points
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-card-accent"></div>
    </div>
</div>