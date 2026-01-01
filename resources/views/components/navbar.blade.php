<style>
    body {
        padding-top: 76px;
    }

    .navbar-smart {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: top 0.4s ease-in-out;
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 1050;
        padding: 0.7rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .navbar-hidden {
        top: -100px;
    }

    .navbar-static {
        position: fixed !important;
        top: 0 !important;
        transition: none !important;
    }

    .nav-link-box {
        color: #444;
        font-weight: 600;
        font-size: 15px;
        padding: 8px 16px !important;
        margin: 0 4px;
        border-radius: 6px;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link-box:hover {
        color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .nav-link-box.active {
        color: #0d6efd;
        font-weight: 700;
    }

    .nav-link-box.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 3px;
        background-color: #0d6efd;
        border-radius: 3px;
    }

    .btn-login-box {
        background: #0d6efd;
        color: white;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        transition: background 0.3s ease;
    }

    .btn-login-box:hover {
        background: #0b5ed7;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }

    .user-avatar-box {
        width: 35px;
        height: 35px;
        background-color: #f0f2f5;
        color: #0d6efd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 1px solid #e1e4e8;
    }

    .dropdown-menu-box {
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        margin-top: 14px !important;
    }
</style>

@php
$routeName = request()->route()->getName();
// Jadikan navbar static jika user login dan perannya salah satu dari pelajar/pengajar/admin,
// atau jika route berada di namespace pelajar./pengajar./admin.
$isProtectedArea = auth()->check() && (
in_array(auth()->user()->peran, ['pelajar', 'pengajar', 'admin']) ||
str($routeName)->startsWith('pelajar.') ||
str($routeName)->startsWith('pengajar.') ||
str($routeName)->startsWith('admin.')
);
@endphp

<nav class="navbar navbar-expand-lg navbar-smart {{ $isProtectedArea ? 'navbar-static' : '' }}" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand py-0" href="{{ route('home') }}">
            <img src="{{ asset('Image/logo.png') }}" alt="Logo" style="height: 50px; width: auto;">
        </a>

        <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox=\'0 0 30 30\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath stroke=\'rgba(0, 0, 0, 0.7)\' stroke-width=\'2.5\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M4 7h22M4 15h22M4 23h22\'/%3E%3C/svg%3E');"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link nav-link-box {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-box {{ request()->routeIs('courses') ? 'active' : '' }}" href="{{ route('courses') }}">Kursus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-box" href="{{ route('home') }}#about">About Me</a>
                </li>

                @auth
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-dark p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar-box me-2">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                        </div>
                        <span class="fw-medium">{{ auth()->user()->nama }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-box" aria-labelledby="navbarDropdown">
                        <li>
                            @php
                            $dashboard = match(auth()->user()->peran) {
                            'pelajar' => 'pelajar.dashboard',
                            'pengajar' => 'pengajar.dashboard',
                            'admin' => 'admin.dashboard',
                            default => 'home'
                            };
                            @endphp
                            <a class="dropdown-item py-2" href="{{ route($dashboard) }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-login-box" href="{{ route('login') }}">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script>
    const navbar = document.getElementById("mainNavbar");

    if (navbar.classList.contains("navbar-static")) {
        navbar.style.top = "0";
    } else {
        let prevScrollpos = window.pageYOffset;

        window.onscroll = function() {
            let currentScrollPos = window.pageYOffset;

            if (prevScrollpos > currentScrollPos) {
                navbar.classList.remove("navbar-hidden");
            } else if (currentScrollPos > 100) {
                navbar.classList.add("navbar-hidden");
            }
            prevScrollpos = currentScrollPos;
        };

        if (window.pageYOffset > 100) {
            navbar.classList.add("navbar-hidden");
        }
    }
</script>