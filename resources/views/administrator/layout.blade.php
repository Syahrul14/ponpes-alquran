<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('content_title') - Administrator Cpanel</title>


    <link rel="icon" href="{{ asset('assets/image_assets/icon/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/administrator_assets/mazer/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/administrator_assets/mazer/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/administrator_assets/mazer/assets/compiled/css/iconly.css') }}">
</head>

<body>
    <script src="{{ asset('assets/administrator_assets/mazer/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        {{-- @include('administrator.sidebar') --}}

        <main id="main" role="main">
            <header class="mb-3 d-flex justify-content-between align-items-center">
                <button class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </button>

                <div class="ms-auto dropdown">
                    <button
                        class="btn btn-link p-0 text-decoration-none d-inline-flex align-items-center gap-2 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            viewBox="0 0 16 16" class="shrink-0">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>

                        {{-- <span class="small">{{ Auth::user()->name }}</span> --}}
                    </button>


                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li>
                            {{-- <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form> --}}
                        </li>
                    </ul>
                </div>


            </header>


            <section class="page-heading">
                <h1>@yield('content_title')</h1>
            </section>


            <section class="page-content">
                @yield('content')
            </section>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2026 &copy;</p>
                    </div>
                </div>
            </footer>
        </main>
    </div>
    <script src="{{ asset('assets/administrator_assets/mazer/assets/static/js/components/dark.js') }}"></script>
    <script
        src="{{ asset('assets/administrator_assets/mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>


    <script src="{{ asset('assets/administrator_assets/mazer/assets/compiled/js/app.js') }}"></script>



    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/administrator_assets/mazer/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/administrator_assets/mazer/assets/static/js/pages/dashboard.js') }}"></script>

</body>

</html>
