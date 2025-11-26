@extends('layouts.app')
@section('title', 'Ulasan Feedback - Mentoring')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main style="flex: 1; padding: 2rem; width: 100%; margin-left: 250px; padding-top: 70px;">
        <div class="container-fluid">
            <!-- Header -->
            <div class="mb-4">
                <a href="{{ route('teacher.mentoring') }}" class="btn btn-outline-secondary btn-sm mb-3">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                </a>
                <h5 class="mb-2">Ulasan Feedback Mentoring</h5>
                <p class="text-muted small">Lihat feedback dan rating dari pelajar</p>
            </div>

            <!-- Info Mentoring -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Topik:</strong> {{ $mentoring->topik }}
                            </p>
                            <p class="mb-2">
                                <strong>Kursus:</strong>
                                @if($mentoring->kursus)
                                {{ $mentoring->kursus->nama }}
                                @else
                                -
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Tanggal:</strong> {{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}
                            </p>
                            <p class="mb-2">
                                <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($mentoring->jam)->format('H:i') }} ({{ $mentoring->durasi }} menit)
                            </p>
                            <p class="mb-0">
                                <strong>Total Feedback:</strong> <span class="badge bg-primary">{{ count($feedbacks) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Rating -->
            @if(count($feedbacks) > 0)
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-body">
                            <h3 class="mb-1 text-warning">
                                @php
                                $avgRating = $feedbacks->avg('rating');
                                @endphp
                                {{ number_format($avgRating, 1) }}
                            </h3>
                            <p class="text-muted small mb-0">Rata-rata Rating</p>
                            <div class="mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <=round($avgRating))
                                    <i class="fa-solid fa-star text-warning"></i>
                                    @else
                                    <i class="fa-regular fa-star text-warning"></i>
                                    @endif
                                    @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $ratingCounts = $feedbacks->groupBy('rating')->map->count();
                @endphp
                <div class="col-md-9">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="mb-3">Distribusi Rating</h6>
                            @for($i = 5; $i >= 1; $i--)
                            @php
                            $count = $ratingCounts->get($i, 0);
                            $percentage = count($feedbacks) > 0 ? ($count / count($feedbacks)) * 100 : 0;
                            @endphp
                            <div class="d-flex align-items-center mb-2">
                                <small class="me-2" style="min-width: 40px;">{{ $i }} <i class="fa-solid fa-star text-warning"></i></small>
                                <div class="progress" style="flex: 1; height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                                </div>
                                <small class="ms-2">{{ $count }}</small>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Daftar Feedback -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h6 class="mb-0">Feedback dari Pelajar</h6>
                </div>
                <div class="card-body">
                    @forelse($feedbacks as $feedback)
                    <div class="mb-4 pb-4 @if(!$loop->last)border-bottom @endif">
                        <!-- Header Feedback -->
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1">{{ $feedback->pelajar->nama }}</h6>
                                <small class="text-muted">{{ $feedback->created_at->locale('id')->translatedFormat('l, d F Y H:i') }}</small>
                            </div>
                            <div class="text-end">
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=$feedback->rating)
                                        <i class="fa-solid fa-star text-warning"></i>
                                        @else
                                        <i class="fa-regular fa-star text-warning"></i>
                                        @endif
                                        @endfor
                                </div>
                                <small class="badge bg-success">{{ $feedback->rating }}/5</small>
                            </div>
                        </div>

                        <!-- Isi Feedback -->
                        <p class="mb-3">{{ $feedback->feedback_text }}</p>

                        <!-- Benefits/Manfaat -->
                        @if($feedback->benefits && count($feedback->benefits) > 0)
                        <div class="mb-0">
                            <strong class="small d-block mb-2">Manfaat yang Didapat:</strong>
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach($feedback->benefits as $benefit)
                                @php
                                $benefitLabels = [
                                'materi_jelas' => 'Materi Jelas',
                                'interaktif' => 'Sesi Interaktif',
                                'pertanyaan_terjawab' => 'Pertanyaan Terjawab'
                                ];
                                @endphp
                                <span class="badge bg-info">{{ $benefitLabels[$benefit] ?? $benefit }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="alert alert-info text-center mb-0">
                        <i class="fa-solid fa-info-circle me-2"></i>
                        Belum ada feedback dari pelajar
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>

@endsection