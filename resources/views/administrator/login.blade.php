<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrator Login</title>

    <link rel="stylesheet"
        href="{{ asset('assets/administrator_assets/mazer/assets/compiled/css/app.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/administrator_assets/mazer/assets/compiled/css/app-dark.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/administrator_assets/mazer/assets/compiled/css/iconly.css') }}">
</head>

<body>

    <div id="auth" class="min-vh-100 d-flex align-items-center justify-content-center">

        <div id="auth-left">

            {{-- Logo --}}
            <div class="auth-logo mb-4 text-center">
                <a href="{{ url('/') }}">
                    <img
                        src="{{ asset('assets/administrator_assets/mazer/assets/compiled/svg/logo.svg') }}"
                        alt="Logo">
                </a>
            </div>

            {{-- Title --}}
            <h1 class="auth-title text-center">
                Administrator Login
            </h1>

            <p class="auth-subtitle text-center mb-5">
                Silakan login untuk mengakses administrator.
            </p>

            {{-- Form --}}
            <form
                action="{{ route('administrator.login.submit') }}"
                method="POST"
            >

                @csrf

                {{-- Username / Email --}}
                <div class="form-group position-relative has-icon-left mb-4">

                    <input
                        type="text"
                        name="username"
                        class="form-control form-control-xl"
                        placeholder="Username atau Email"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        required
                    >

                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>

                </div>

                @error('username')
                    <div class="text-danger small mb-3">
                        {{ $message }}
                    </div>
                @enderror

                {{-- Password --}}
                <div class="form-group position-relative has-icon-left mb-4">

                    <input
                        type="password"
                        name="password"
                        class="form-control form-control-xl"
                        placeholder="Password"
                        autocomplete="current-password"
                        required
                    >

                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                </div>

                @error('password')
                    <div class="text-danger small mb-3">
                        {{ $message }}
                    </div>
                @enderror

                {{-- Submit --}}
                <button
                    type="submit"
                    class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                >
                    Login
                </button>

            </form>

        </div>

    </div>

    <script src="{{ asset('assets/administrator_assets/mazer/assets/static/js/components/dark.js') }}"></script>

    <script src="{{ asset('assets/administrator_assets/mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/administrator_assets/mazer/assets/compiled/js/app.js') }}"></script>

</body>

</html>