<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" style="margin-bottom:0; padding-bottom:0;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('Image/logo.png') }}" alt="Logo" style="height:40px;">
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('courses') ? 'active fw-bold text-primary' : '' }}" href="{{ route('courses') }}">Kursus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#about">About Me</a>
                </li>

                @auth
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-dark fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 14px;">
                            {{ substr(auth()->user()->nama, 0, 1) }}
                        </div>
                        {{ auth()->user()->nama }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2 animate slideIn" aria-labelledby="navbarDropdown">
                        <li>
                            @if (auth()->user()->peran === 'pelajar')
                            <a class="dropdown-item py-2" href="{{ route('pelajar.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                            @elseif (auth()->user()->peran === 'pengajar')
                            <a class="dropdown-item py-2" href="{{ route('pengajar.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                            @elseif (auth()->user()->peran === 'admin')
                            <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                            @endif
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" href="{{ route('login') }}">Login</a>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>