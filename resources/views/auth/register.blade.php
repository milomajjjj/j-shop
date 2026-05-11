<x-layout>

<section class="auth-page-wrapper">

    <!-- GLOWS -->
    <div class="auth-glow auth-glow-1"></div>
    <div class="auth-glow auth-glow-2"></div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- CARD -->
        <div class="premium-auth-card">

            <!-- TITLE -->
            <h1 class="auth-main-title">
                Create account
            </h1>

            <p class="auth-subtitle">
                Join JShop and start shopping today.
            </p>

            <!-- FORM -->
            <form action="{{ route('registerAction') }}" method="POST">

                @csrf

                <!-- NAME -->
                <div class="mb-3">

                    <label class="premium-label mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control auth-input"
                        placeholder="Name Surname"
                        required
                    >

                    @error('name')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

                <!-- EMAIL -->
                <div class="mb-3">

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

                    @error('email')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

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

                    @error('password')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

                <!-- CONFIRM -->
                <div class="mb-3">

                    <label class="premium-label mb-2">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control auth-input"
                        placeholder="••••••••"
                        required
                    >

                </div>

                <!-- TERMS -->
                <div class="form-check mb-4">

                    <input
                        type="checkbox"
                        name="terms"
                        class="form-check-input"
                        id="terms"
                    >

                    <label class="form-check-label text-light" for="terms">

                        I agree to
                        <a href="#" class="forgot-link">
                            terms of policy
                        </a>

                    </label>

                </div>

                @error('terms')

                    <small class="text-danger d-block mb-3">
                        {{ $message }}
                    </small>

                @enderror

                <!-- BUTTON -->
                <button type="submit" class="gradient-btn">

                    Create account

                </button>

                <!-- LOGIN -->
                <p class="auth-bottom-text">

                    Already have an account?

                    <a href="{{ route('login') }}">
                        Sign in
                    </a>

                </p>

            </form>

        </div>

    </div>

</section>

</x-layout>