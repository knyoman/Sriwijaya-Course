<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <!-- <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('Image/logo.png') }}" alt="Logo" style="height:50px;">
        </a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.courses') }}">
                        <i class="fa-solid fa-graduation-cap me-1"></i> Entry Kursus
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.mentoring') }}">
                        <i class="fa-solid fa-calendar-days me-1"></i> Jadwal Mentoring
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.profile') }}">
                        <i class="fa-solid fa-user me-1"></i> Profil Akun
                    </a>
                </li>
                <li class="nav-item ms-3">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>