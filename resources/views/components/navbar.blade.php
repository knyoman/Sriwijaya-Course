<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Sriwijaya Course</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses') }}">Kursus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#about">About Me</a>
                </li>
                @if (auth()->check())
                <li class="nav-item ms-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->nama }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if (auth()->user()->peran === 'pelajar')
                            <li><a class="dropdown-item" href="{{ route('pelajar.dashboard') }}">Dashboard</a></li>
                            @elseif (auth()->user()->peran === 'pengajar')
                            <li><a class="dropdown-item" href="{{ route('pengajar.dashboard') }}">Dashboard</a></li>
                            @elseif (auth()->user()->peran === 'admin')
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item ms-3">
                    <a class="btn btn-primary text-white" href="{{ route('login') }}">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>