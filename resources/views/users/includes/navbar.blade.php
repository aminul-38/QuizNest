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

    /* Navigation Links */

    .nav-links {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, .12);
        padding: 6px;
        border: 1px solid var(--border);
        border-radius: 50px;
    }

    .nav-links a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 50px;
        color: rgba(255, 255, 255, .85);
        text-decoration: none;
        font-weight: 600;
        transition: .25s ease;
        white-space: nowrap;
    }

    .nav-links a:hover {
        color: #fff;
        background: rgba(255, 255, 255, .15);
    }

    .nav-links a.active {
        background: #fff;
        color: var(--primary);
        box-shadow: 0 5px 15px rgba(0, 0, 0, .12);
    }

    .nav-links i {
        font-size: 1rem;
    }

    /* Profile Button */
    .user-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: .25s ease;
    }

    .profile-btn {
        width: 54px;
        height: 54px;
        padding: 3px;
        border: 1px solid rgba(255, 255, 255, .25);
        background: rgba(255, 255, 255, .12);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        cursor: pointer;
        transition: .25s ease;
    }

    .profile-btn:hover,
    .profile-btn.show {
        background: rgba(255, 255, 255, .22);
        border-color: rgba(255, 255, 255, .45);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
    }

    .profile-btn:focus {
        box-shadow: none;
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

    .dropdown-item.active {
        position: relative;
        background: #f3efff;
        color: var(--primary);
        font-weight: 600;
    }

    .dropdown-item.active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 20%;
        width: 3px;
        height: 60%;
        border-radius: 0 4px 4px 0;
        background: var(--primary);
    }

    .dropdown-item.active i {
        color: var(--primary);
    }

    /* Mobile */

    @media(max-width: 768px) {
        .home-nav {
            flex-wrap: wrap;
            gap: 15px;
            padding: 15px;
        }

        .nav-links {
            order: 3;
            width: 100%;
            justify-content: center;
            overflow-x: auto;
        }

        .nav-links::-webkit-scrollbar {
            display: none;
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

    <div class="nav-links">
        <a href="{{ route('home') }}">
            Home
        </a>
        @if(session('user_role')=="Creator")
        <a
            href="{{ route('profile.manage.quizzes',['userID'=>session('user_id'),'userName'=>session('user_name')]) }}"
            class="{{ request()->routeIs('profile.manage.quizzes') ? 'active' : '' }}">
            Manage Quizzes
        </a>
        <a
            href="{{ route('create.quiz',['userID'=>session('user_id'),'userName'=>session('user_name')]) }}"
            class="{{ request()->routeIs('create.quiz') ? 'active' : '' }}">
            Create Quiz
        </a>
        @else
        <a
            href="{{ route('profile.my.attempts',['userID'=>session('user_id'),'userName'=>session('user_name')]) }}"
            class="{{ request()->routeIs('profile.my.attempts') ? 'active' : '' }}">
            My Attempts
        </a>
        <a
            href="{{ route('profile.my.results',['userID'=>session('user_id'),'userName'=>session('user_name')]) }}"
            class="{{ request()->routeIs('profile.my.results') ? 'active' : '' }}">
            My Results
        </a>
        @endif
    </div>

    <div class="dropdown">
        <button
            class="profile-btn"
            title="Menu"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{ asset(session('user_profile_picture')) }}"
                class="user-avatar">
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a
                    class="dropdown-item {{request()->routeIs('profile.show') && request()->route('userID') == session('user_id') && request()->route('userName') == session('user_name') ? 'active' : '' }}"
                    href="{{ route('profile.show', ['userID' => session('user_id'),'userName' => session('user_name')]) }}">
                    <i class="bi bi-person me-2"></i>
                    Profile
                </a>
            </li>

            <li>
                <a
                    class="dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                    href="{{ route('profile.edit', [
                    'userID' => session('user_id'),
                    'userName' => session('user_name')
                ]) }}">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Profile
                </a>
            </li>

            <li>
                <a
                    class="dropdown-item {{ request()->routeIs('profile.change.password') ? 'active' : '' }}"
                    href="{{ route('profile.change.password',['userID'=>session('user_id'),'userName'=>session('user_name')]) }}">
                    <i class="bi bi-key-fill me-2"></i>
                    Change Password
                </a>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a
                    class="dropdown-item text-danger"
                    href="{{ route('auth.logout') }}">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>