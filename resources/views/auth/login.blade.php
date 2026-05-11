<x-layout>

<section class="auth-page-wrapper">

    <!-- GLOW -->
    <div class="auth-glow auth-glow-1"></div>
    <div class="auth-glow auth-glow-2"></div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- CARD -->
        <div class="premium-auth-card">

            <!-- TITLE -->
            <h1 class="auth-main-title">
                Welcome back
            </h1>

            <p class="auth-subtitle">
                Log in to your JShop account.
            </p>

            <!-- ERROR -->
            @if(session('error'))

                <div class="alert alert-danger text-center mb-4">
                    {{ session('error') }}
                </div>

            @endif

            <!-- FORM -->
            <form action="{{ route('loginAction') }}" method="POST">

                @csrf

                <!-- EMAIL -->
                <div class="mb-4">

                    <label class="premium-label mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control auth-input"
                        placeholder="you@example.com"
                        required
                    >

                </div>

                <!-- PASSWORD -->
                <div class="mb-3">

                    <label class="premium-label mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control auth-input"
                        placeholder="••••••••"
                        required
                    >

                </div>

                <!-- FORGOT -->
                <div class="text-end mb-4">

                    <a href="{{ route('password.request') }}"
                       class="forgot-link">

                        Forgot Password?

                    </a>

                </div>

                <!-- BUTTON -->
                <button type="submit" class="gradient-btn">

                    Log in

                </button>

                <!-- REGISTER -->
                <p class="auth-bottom-text">

                    New here?

                    <a href="{{ route('register') }}">
                        Create an account
                    </a>

                </p>

            </form>

        </div>

    </div>

</section>

</x-layout>