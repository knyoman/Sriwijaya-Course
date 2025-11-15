<div class="bg-white" style="min-height:100vh; border-right:1px solid #eee; width:260px;">
    <div class="p-4 border-bottom">
        <button class="btn btn-outline-secondary btn-sm">Sriwijaya Course</button>
    </div>

    <div class="list-group list-group-flush p-3">
        <a href="{{ route('teacher.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa-solid fa-grid-2 me-3 text-primary"></i>
            Dashboard
        </a>

        <a href="{{ route('teacher.courses') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa-solid fa-book me-3"></i>
            Entry Kursus
        </a>

        <a href="{{ route('teacher.mentoring') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa-regular fa-calendar me-3"></i>
            Jadwal Mentoring
        </a>

        <a href="{{ route('teacher.profile') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa-solid fa-user me-3"></i>
            Profil Akun
        </a>

        <a href="{{ route('teacher.certificates') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa-solid fa-award me-3"></i>
            Sertifikat
        </a>
    </div>
</div>