<style>
    .auth-navbar {
        display: flex;
        align-items: center;
        background-color: #8f5cff;
        max-height: 500px;
        padding: 12px 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
        /* border: 1px solid black; */
    }

    .home-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        margin-left: 10px;
    }

    .logo {
        width: 60px;
        height: 60px;
        /* border: 1px solid black; */
    }

    .logo-text {
        color: white;
        font-size: 3.1rem;
        font-weight: 700;
        margin-left: 10px;
        margin-bottom: 0;
        /* border: 1px solid black; */
    }
</style>
<div class="auth-navbar">
    <a href="{{route('home')}}" class="home-link">
        <img class="logo" src="images/logo.png" alt="logo">
        <h1 class="logo-text">QuizNest</h1>
    </a>
</div>