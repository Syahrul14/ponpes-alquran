@extends('website.layout')

@section('title', 'Informasi')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Informasi</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section class="informasi py-5 bg-light">
    <div class="container">

        <!-- Title -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Informasi Terbaru</h2>
            <p class="text-muted">Berita & pengumuman terbaru dari Ponpes</p>
        </div>

        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <small class="text-muted">10 Juni 2026</small>
                        <h5 class="fw-bold mt-2">Kegiatan Santri Bulan Ini</h5>
                        <p class="text-muted">Berbagai kegiatan positif santri selama bulan ini yang penuh dengan pembelajaran...</p>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <a href="/informasi/informasi/detail" class="btn btn-outline-danger btn-sm w-100">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <small class="text-muted">05 Juni 2026</small>
                        <h5 class="fw-bold mt-2">Penerimaan Santri Baru</h5>
                        <p class="text-muted">Pendaftaran santri baru telah dibuka. Segera daftarkan putra-putri anda...</p>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <a href="/informasi/informasi/detail" class="btn btn-outline-danger btn-sm w-100">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <small class="text-muted">01 Juni 2026</small>
                        <h5 class="fw-bold mt-2">Prestasi Santri</h5>
                        <p class="text-muted">Santri kami berhasil meraih prestasi dalam lomba tingkat nasional...</p>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <a href="/informasi/informasi/detail" class="btn btn-outline-danger btn-sm w-100">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- <!-- Pagination (optional) -->
        <div class="text-center mt-5">
            <a href="#" class="btn btn-danger px-4">Lihat Semua Informasi</a>
        </div> --}}

    </div>
</section>
@endsection
