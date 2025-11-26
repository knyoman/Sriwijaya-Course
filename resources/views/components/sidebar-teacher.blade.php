<style>
    .sidebar {
        width: 250px;
        /* Lebar standar agar konsisten dengan student */
        height: calc(100vh - 56px);
        position: fixed;
        left: 0;
        top: 56px;
        background: #ffffff;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        overflow-y: auto;
        z-index: 100;
        padding: 1.5rem 1rem;
    }

    .nav-item-custom {
        border-radius: 10px;
        padding: 0.8rem 1rem;
        color: #6c757d;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border: none;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .nav-item-custom:hover {
        background-color: #f0f7ff;
        color: #007bff;
        transform: translateX(5px);
    }

    /* State Aktif */
    .nav-item-custom.active {
        background-color: #007bff;
        color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);
    }

    .nav-item-custom.active i {
        color: #ffffff !important;
    }

    .nav-icon {
        width: 24px;
        margin-right: 12px;
        text-align: center;
        font-size: 1.1rem;
    }

    .sidebar-divider {
        height: 1px;
        background-color: #e9ecef;
        margin: 1rem 0;
    }

    .menu-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #adb5bd;
        font-weight: 700;
        margin-bottom: 0.5rem;
        padding-left: 1rem;
        letter-spacing: 1px;
    }
</style>

<div class="sidebar">

    <div class="menu-label">Manajemen</div>

    <a href="{{ route('teacher.dashboard') }}" class="nav-item-custom {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-gauge-high nav-icon"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('teacher.courses') }}" class="nav-item-custom {{ request()->routeIs('teacher.courses') ? 'active' : '' }}">
        <i class="fa-solid fa-book nav-icon"></i>
        <span>Entry Kursus</span>
    </a>

    <a href="{{ route('teacher.mentoring') }}" class="nav-item-custom {{ request()->routeIs('teacher.mentoring') ? 'active' : '' }}">
        <i class="fa-regular fa-calendar nav-icon"></i>
        <span>Jadwal Mentoring</span>
    </a>

    <div class="sidebar-divider"></div>

    <div class="menu-label">Pengaturan</div>

    <a href="{{ route('teacher.profile') }}" class="nav-item-custom {{ request()->routeIs('teacher.profile') ? 'active' : '' }}">
        <i class="fa-solid fa-user nav-icon"></i>
        <span>Profil Akun</span>
    </a>

</div>