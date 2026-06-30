<style>
    :root {
        --primary: #7431f9;
        --primary-dark: #5e20db;
        --light: #ffffff;
        --border: rgba(255, 255, 255, 0.15);
    }

    .home-nav {
        position: sticky;
        top: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 40px;
        background-color: #8f5cff;
        box-shadow: 0 4px 20px rgba(116, 49, 249, 0.25);
    }

    /* Logo Section */

    .home-link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        transition: .3s;
    }

    .home-link:hover {
        transform: scale(1.03);
    }

    .logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .logo-text {
        margin: 0;
        font-size: 2.4rem;
        font-weight: 700;
        color: white;
        letter-spacing: .5px;
    }


    /* Search Box */

    .search-form {
        width: 550px;
    }

    .search-wrapper {
        display: flex;
        align-items: center;
        margin: 0 10px;
        background: rgba(255, 255, 255, .15);
        backdrop-filter: blur(10px);
        border: 1px solid var(--border);
        border-radius: 50px;
        overflow: hidden;
        transition: .3s;
    }

    .search-wrapper:hover {
        background: rgba(255, 255, 255, .2);
    }

    .search-wrapper:focus-within {
        border-color: rgba(255, 255, 255, .6);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .15);
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 12px 18px;
        background: transparent;
        color: white;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, .7);
    }

    .search-btn {
        border: none;
        background: white;
        color: var(--primary-dark);
        padding: 10px 20px;
        font-weight: 600;
        transition: .3s;
    }

    .search-btn:hover {
        background: #f3f3f3;
    }

    /* Profile Button */
    .user-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-btn {
        width: 50px;
        height: 50px;
        padding: 0;
        overflow: hidden;
        border-radius: 50%;
        border: 2px solid var(--primary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .3s;
    }

    .profile-btn:hover {
        transform: scale(1.08);
    }

    .dropdown-menu {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
    }

    .dropdown-item {
        padding: 10px 18px;
        transition: .2s;
    }

    .dropdown-item:hover {
        background: #f3efff;
        color: var(--primary);
    }

    /* Mobile */

    @media(max-width: 768px) {
        .home-nav {
            flex-wrap: wrap;
            gap: 15px;
            padding: 15px;
        }

        .search-form {
            width: 100%;
            order: 3;
        }

        .search-wrapper {
            margin: 0;
        }

        .logo-text {
            font-size: 1.2rem;
        }
    }
</style>


<div class="home-nav">
    <div>
        <a href="{{ route('home') }}" class="home-link">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="QuizNest">
            <p class="logo-text">QuizNest</p>
        </a>
    </div>

    <form
        class="search-form"
        method="GET"
        action="{{ route('quiz.search') }}">
        @csrf
        <div class="search-wrapper">
            <input
                type="text"
                name="key"
                class="search-input"
                placeholder="Search quizzes by title or author name..."
                required>
            <button class="search-btn" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    <div class="dropdown">
        <button
            class="profile-btn"
            title="Menu"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            @if( session('user_profile_picture') )
            <img src="{{asset(session('user_profile_picture'))}}"
                class="user-avatar">
            @else
            <img src="{{asset('images/profile_pictures/profile-logo.png')}}"
                class="user-avatar">
            @endif
        </button>

        @if(session('user_id'))
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a
                    class="dropdown-item"
                    href="{{ route('profile.show',['userID'=>session('user_id'),'userName'=>session('user_name')]) }}">
                    <i class="bi bi-person me-2"></i>
                    Profile
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-trophy me-2"></i>
                    My Scores
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-gear me-2"></i>
                    Settings
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </li>
        </ul>
        @else
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('auth.login') }}">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Login
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('auth.registration') }}">
                    <i class="bi bi-person-plus me-2"></i>
                    Registration
                </a>
            </li>
        </ul>
        @endif
    </div>
</div>