<div class="bg-white" style="min-height:100vh; border-right:1px solid #eee; width:170px; position: fixed; left: 0; top: 56px; overflow-y: auto;">
    <div class="p-3 border-bottom" style="border-bottom: 1px solid #f0f0f0;">
        <button class="btn btn-light btn-sm w-100" style="border: 1px solid #ddd; font-size: 0.85rem;" disabled>
            Sriwijaya Course
        </button>
    </div>

    <div class="list-group list-group-flush p-2" style="border: none;">
        <a href="{{ route('pelajar.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-solid fa-gauge-high me-2" style="color: #007bff; width: 20px;"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('student.my-courses') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-solid fa-book me-2" style="width: 20px;"></i>
            <span>My Kursus</span>
        </a>
        <a href="{{ route('student.courses') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-solid fa-graduation-cap me-2" style="width: 20px;"></i>
            <span>Cari Kursus</span>
        </a>
        <a href="{{ route('student.certificates') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-solid fa-award me-2" style="width: 20px;"></i>
            <span>Sertifikat</span>
        </a>
        <a href="{{ route('student.mentoring') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-regular fa-calendar me-2" style="width: 20px;"></i>
            <span>Jadwal Mentoring</span>
        </a>
        <a href="{{ route('student.payments') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-solid fa-folder-open me-2" style="width: 20px;"></i>
            <span>Riwayat Pembayaran</span>
        </a>

        <div style="border-top: 1px solid #f0f0f0; margin: 0.5rem 0;"></div>

        <a href="{{ route('student.profile') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="border: none; padding: 0.75rem 1rem; font-size: 0.95rem;">
            <i class="fa-solid fa-user me-2" style="width: 20px;"></i>
            <span>Akun Profil</span>
        </a>
    </div>
</div>