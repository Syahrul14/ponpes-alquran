@extends('administrator.layout')
@section('content_title', 'Dashboard')

@section('content')
<!-- Hero Welcome Banner -->
<div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
    <div class="card-body p-4 p-md-5 text-white">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-3">
                    <i class="bi bi-shield-check me-1"></i> Panel Administrator Ponpes
                </span>
                <h2 class="fw-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}! 👋</h2>
                <p class="text-secondary mb-4 mb-lg-0" style="max-width: 600px;">
                    Hari ini <strong>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</strong>. 
                    Kelola seluruh konten, publikasi informasi, dan pantau pesan masuk dari calon santri dengan mudah dan efisien.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-light btn-sm px-3 py-2 rounded-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Website
                    </a>
                    <a href="{{ route('admin.contact_messages.getData') }}" class="btn btn-success btn-sm px-3 py-2 rounded-3">
                        <i class="bi bi-envelope-fill me-1"></i> Kotak Pesan
                        @if ($unreadMessagesCount > 0)
                            <span class="badge bg-danger ms-1">{{ $unreadMessagesCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4 Metrik Kartu Statistik -->
<div class="row g-3 mb-4">
    <!-- Card 1: Pesan Masuk -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 {{ $unreadMessagesCount > 0 ? 'border-start border-4 border-warning' : 'border-start border-4 border-success' }}">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase">Pesan Masuk</span>
                    <div class="rounded-circle {{ $unreadMessagesCount > 0 ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' }} d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-chat-dots-fill fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-1 {{ $unreadMessagesCount > 0 ? 'text-warning' : 'text-dark' }}">
                    {{ $unreadMessagesCount }}
                    <small class="fs-6 text-muted fw-normal">baru</small>
                </h3>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <span class="small text-muted">Total: {{ $totalMessagesCount }}</span>
                    <a href="{{ route('admin.contact_messages.getData') }}" class="small text-decoration-none fw-semibold">
                        Lihat <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Berita & Pengumuman -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-primary">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase">Berita & Info</span>
                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-newspaper fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-1 text-dark">
                    {{ $totalNewsCount }}
                    <small class="fs-6 text-muted fw-normal">artikel</small>
                </h3>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <span class="small text-muted">{{ $totalInfoCount }} Pengumuman</span>
                    <a href="{{ route('admin.news.getData') }}" class="small text-decoration-none fw-semibold">
                        Kelola <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Akademik & Prestasi -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-info">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase">Program & Prestasi</span>
                    <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-trophy-fill fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-1 text-dark">
                    {{ $totalPrestasi }}
                    <small class="fs-6 text-muted fw-normal">prestasi</small>
                </h3>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <span class="small text-muted">{{ $totalPrograms }} Program | {{ $totalFacilities }} Fasilitas</span>
                    <a href="{{ route('admin.prestasi_card.getData') }}" class="small text-decoration-none fw-semibold">
                        Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Infaq & Donasi -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-danger">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-semibold text-uppercase">Kanal Infaq</span>
                    <div class="rounded-circle bg-danger-subtle text-danger d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-heart-fill fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-1 text-dark">
                    {{ $totalBanks }}
                    <small class="fs-6 text-muted fw-normal">rekening</small>
                </h3>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <span class="small {{ $qris ? 'text-success' : 'text-muted' }}">
                        <i class="bi bi-qr-code me-1"></i>{{ $qris ? 'QRIS Aktif' : 'QRIS Belum Ada' }}
                    </span>
                    <a href="{{ route('admin.infaq_bank.getData') }}" class="small text-decoration-none fw-semibold">
                        Kelola <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Feed Aktivitas Terkini (col-lg-8) -->
    <div class="col-lg-8">
        <!-- 1. Pesan Masuk Terbaru -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0 text-dark">
                        <i class="bi bi-chat-left-text-fill me-2 text-warning"></i>Pesan Masuk Terbaru
                    </h5>
                    <small class="text-muted">Pesan pertanyaan dari pengunjung dan calon wali santri</small>
                </div>
                <a href="{{ route('admin.contact_messages.getData') }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                    Lihat Semua ({{ $totalMessagesCount }})
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Pengirim</th>
                                <th>Subjek Pesan</th>
                                <th>Waktu</th>
                                <th style="width: 100px;" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentMessages as $msg)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $msg->name }}</div>
                                        <small class="text-muted">{{ $msg->email }}</small>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 260px;" title="{{ $msg->subject }}">
                                            {{ $msg->subject }}
                                        </div>
                                        <small class="text-muted text-truncate d-block" style="max-width: 260px;">
                                            {{ Str::limit($msg->message, 45) }}
                                        </small>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $msg->created_at ? $msg->created_at->diffForHumans() : '-' }}
                                    </td>
                                    <td class="text-center">
                                        @if (!$msg->is_read)
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                                <i class="bi bi-envelope-fill me-1"></i>Baru
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">
                                                <i class="bi bi-check2-all me-1"></i>Dibaca
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        Belum ada pesan masuk dari pengunjung.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 2. Berita Terakhir Diterbitkan -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0 text-dark">
                        <i class="bi bi-newspaper me-2 text-primary"></i>Berita & Artikel Terakhir
                    </h5>
                    <small class="text-muted">Publikasi artikel kegiatan santri terbaru di website</small>
                </div>
                <a href="{{ route('admin.news.getData') }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                    Kelola Berita
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;" class="text-center">Foto</th>
                                <th>Judul Artikel</th>
                                <th>Tanggal Terbit</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentNews as $news)
                                <tr>
                                    <td class="text-center">
                                        @if ($news->image)
                                            <img src="{{ asset('storage/' . $news->image) }}" alt="Thumbnail" class="rounded-3 shadow-sm" style="width: 50px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded-3 bg-light text-muted d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark text-truncate" style="max-width: 320px;" title="{{ $news->title }}">
                                            {{ $news->title }}
                                        </div>
                                        <small class="text-muted">
                                            <i class="bi bi-link-45deg"></i> /informasi/berita/{{ $news->slug }}
                                        </small>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $news->created_at ? $news->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('/informasi/berita/' . $news->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Lihat di Web">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-journal-x fs-3 d-block mb-1"></i>
                                        Belum ada berita yang diterbitkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Pintasan Aksi & Profil Sistem (col-lg-4) -->
    <div class="col-lg-4">
        <!-- Card 3: Pintasan Cepat (Quick Actions) -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 text-dark">
                    <i class="bi bi-lightning-charge-fill me-2 text-warning"></i>Pintasan Aksi Cepat
                </h5>
            </div>
            <div class="card-body p-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.news.getData') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between hover-shadow">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary-subtle text-primary p-2 me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-pencil-fill"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Tulis Berita Baru</strong>
                                <small class="text-muted">Publikasi artikel kegiatan</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.prestasi_card.getData') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info-subtle text-info p-2 me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Tambah Prestasi Santri</strong>
                                <small class="text-muted">Rekam jejak kejuaraan</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.program_card.getData') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success-subtle text-success p-2 me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Program Pembelajaran</strong>
                                <small class="text-muted">Kelola kurikulum ponpes</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.footer_setting.getData') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-secondary-subtle text-dark p-2 me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-gear-fill"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Pengaturan Web & Logo</strong>
                                <small class="text-muted">Identitas & media sosial</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.management.getData') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-danger-subtle text-danger p-2 me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Manajemen Pengelola</strong>
                                <small class="text-muted">{{ $totalAdmins }} akun administrator</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4: Identitas & Status Sistem -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 text-dark">
                    <i class="bi bi-info-circle-fill me-2 text-primary"></i>Status Sistem & Identitas
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="p-3 bg-light rounded-4 border d-inline-block shadow-sm mb-3">
                    @if ($footerSetting && !empty($footerSetting->logo))
                        <img src="{{ asset('storage/' . $footerSetting->logo) }}" alt="Logo Ponpes" style="max-height: 55px; max-width: 140px; object-fit: contain;">
                    @else
                        <img src="{{ asset('assets/images/core/logo.png') }}" alt="Logo Ponpes" style="max-height: 55px; max-width: 140px; object-fit: contain;">
                    @endif
                </div>
                <h6 class="fw-bold text-dark mb-1">{{ $footerSetting->pesantren_name ?? "Ponpes Al-Qur'an Rizky Amalia" }}</h6>
                <p class="small text-muted mb-3">
                    <i class="bi bi-whatsapp text-success me-1"></i>{{ $contactInfo->phone ?? '0812-3456-7890' }} | 
                    <i class="bi bi-envelope text-primary me-1"></i>{{ $contactInfo->email ?? 'info@ponpes.com' }}
                </p>

                <div class="bg-success-subtle text-success p-2 rounded-3 small fw-semibold">
                    <i class="bi bi-check-circle-fill me-1"></i> Seluruh Modul Berjalan Normal
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

