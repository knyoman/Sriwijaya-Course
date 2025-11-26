<style>
    .sidebar {
        width: 250px;
        height: calc(100vh - 56px);
        /* Sesuaikan dengan tinggi navbar atas */
        position: fixed;
        left: 0;
        top: 56px;
        background: #ffffff;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        /* Shadow halus pengganti border */
        overflow-y: auto;
        z-index: 100;
        padding: 1.5rem 1rem;
    }

    .nav-item-custom {
        border-radius: 10px;
        padding: 0.8rem 1rem;
        color: #6c757d;
        /* Warna teks abu-abu soft */
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border: none;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    /* Efek Hover */
    .nav-item-custom:hover {
        background-color: #f0f7ff;
        /* Biru sangat muda */
        color: #007bff;
        /* Biru utama */
        transform: translateX(5px);
        /* Geser sedikit ke kanan */
    }

    /* State Aktif (Halaman yang sedang dibuka) */
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

    <div class="menu-label">Menu Utama</div>

    <a href="{{ route('pelajar.dashboard') }}" class="nav-item-custom {{ request()->routeIs('pelajar.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-gauge-high nav-icon"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('student.my-courses') }}" class="nav-item-custom {{ request()->routeIs('student.my-courses') ? 'active' : '' }}">
        <i class="fa-solid fa-book nav-icon"></i>
        <span>My Kursus</span>
    </a>

    <a href="{{ route('student.courses') }}" class="nav-item-custom {{ request()->routeIs('student.courses') ? 'active' : '' }}">
        <i class="fa-solid fa-graduation-cap nav-icon"></i>
        <span>Cari Kursus</span>
    </a>

    <a href="{{ route('student.certificates') }}" class="nav-item-custom {{ request()->routeIs('student.certificates') ? 'active' : '' }}">
        <i class="fa-solid fa-award nav-icon"></i>
        <span>Sertifikat</span>
    </a>

    <a href="{{ route('student.mentoring') }}" class="nav-item-custom {{ request()->routeIs('student.mentoring') ? 'active' : '' }}">
        <i class="fa-regular fa-calendar nav-icon"></i>
        <span>Jadwal Mentoring</span>
    </a>

    <a href="{{ route('student.payments') }}" class="nav-item-custom {{ request()->routeIs('student.payments') ? 'active' : '' }}">
        <i class="fa-solid fa-folder-open nav-icon"></i>
        <span>Riwayat Pembayaran</span>
    </a>

    <div class="sidebar-divider"></div>

    <div class="menu-label">Pengaturan</div>

    <a href="{{ route('student.profile') }}" class="nav-item-custom {{ request()->routeIs('student.profile') ? 'active' : '' }}">
        <i class="fa-solid fa-user nav-icon"></i>
        <span>Akun Profil</span>
    </a>

</div>