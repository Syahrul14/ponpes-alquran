@extends('website.layout')

@section('title', 'Prestasi')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Berita</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section class="fasilitas py-5 bg-light">
  <div class="container">

    <div class="row g-4">

      <!-- CARD 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card berita-card border-0 shadow-sm h-100">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" 
                 class="card-img-top berita-img" 
                 alt="Berita">
          </div>
          <div class="card-body d-flex flex-column">
            <small class="text-muted mb-2">
              <i class="fas fa-calendar-alt me-1"></i> 12 Juni 2026
            </small>
            <h5 class="fw-bold mb-2">
              Kegiatan Hafalan Santri
            </h5>
            <p class="text-muted small flex-grow-1">
              Santri rutin melakukan hafalan Al-Qur'an setiap hari dengan metode yang efektif dan terarah.
            </p>
            <a href="/informasi/berita/detail" class="btn btn-sm btn-danger mt-2 align-self-start">
              Baca Selengkapnya
            </a>
          </div>
        </div>
      </div>

      <!-- CARD 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card berita-card border-0 shadow-sm h-100">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" 
                 class="card-img-top berita-img" 
                 alt="Berita">
          </div>
          <div class="card-body d-flex flex-column">
            <small class="text-muted mb-2">
              <i class="fas fa-calendar-alt me-1"></i> 10 Juni 2026
            </small>
            <h5 class="fw-bold mb-2">
              Lomba Tilawah Antar Santri
            </h5>
            <p class="text-muted small flex-grow-1">
              Diadakan lomba tilawah untuk meningkatkan kemampuan membaca Al-Qur'an dengan tartil.
            </p>
            <a href="/informasi/berita/detail" class="btn btn-sm btn-danger mt-2 align-self-start">
              Baca Selengkapnya
            </a>
          </div>
        </div>
      </div>

      <!-- CARD 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card berita-card border-0 shadow-sm h-100">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" 
                 class="card-img-top berita-img" 
                 alt="Berita">
          </div>
          <div class="card-body d-flex flex-column">
            <small class="text-muted mb-2">
              <i class="fas fa-calendar-alt me-1"></i> 8 Juni 2026
            </small>
            <h5 class="fw-bold mb-2">
              Kegiatan Kajian Rutin
            </h5>
            <p class="text-muted small flex-grow-1">
              Kajian rutin setiap pekan untuk memperdalam pemahaman agama dan akhlak santri.
            </p>
            <a href="/informasi/berita/detail" class="btn btn-sm btn-danger mt-2 align-self-start">
              Baca Selengkapnya
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<style>
  .berita-card {
    border-radius: 12px;
    transition: all 0.3s ease;
  }

  .berita-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
  }

  .berita-img {
    height: 200px;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .berita-card:hover .berita-img {
    transform: scale(1.08);
  }
</style>
@endsection
