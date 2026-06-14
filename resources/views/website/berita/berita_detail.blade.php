@extends('website.layout')

@section('title', 'Detail Berita')

@section('content')

<!-- HERO -->
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5 text-center" style="z-index: 2;" data-aos="fade-up">
        <h1 class="fw-bold display-5">Detail Berita</h1>
        <p class="text-white-50">Ponpes Al-Qur'an Rizky Amalia</p>
    </div>
</section>

<!-- CONTENT -->
<section class="py-5 bg-light">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="card border-0 shadow-sm berita-detail">

          <!-- IMAGE -->
          <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" 
               class="img-fluid rounded-top berita-detail-img" 
               alt="Berita">

          <!-- BODY -->
          <div class="card-body p-4">

            <!-- DATE -->
            <small class="text-muted d-block mb-2">
              <i class="fas fa-calendar-alt me-1"></i> 12 Juni 2026
            </small>

            <!-- TITLE -->
            <h2 class="fw-bold mb-3">
              Kegiatan Hafalan Santri
            </h2>

            <!-- CONTENT -->
            <div class="berita-content text-muted">
              <p>
                Kegiatan hafalan Al-Qur'an merupakan aktivitas utama para santri di Ponpes Al-Qur'an Rizky Amalia. 
                Setiap hari, santri dibimbing oleh para ustadz untuk meningkatkan kualitas hafalan mereka.
              </p>

              <p>
                Metode yang digunakan dirancang agar santri tidak hanya menghafal, tetapi juga memahami isi kandungan Al-Qur'an.
                Suasana belajar yang nyaman dan kondusif menjadi salah satu faktor keberhasilan program ini.
              </p>

              <p>
                Dengan adanya kegiatan ini, diharapkan para santri mampu menjadi generasi yang berakhlak mulia 
                dan memiliki pemahaman agama yang kuat.
              </p>
            </div>

            <!-- BACK BUTTON -->
            <a href="#" class="btn btn-outline-danger mt-4">
              <i class="fas fa-arrow-left me-1"></i> Kembali ke Berita
            </a>

          </div>

        </div>

      </div>
    </div>

  </div>
</section>

<style>
  .berita-detail {
    border-radius: 12px;
  }

  .berita-detail-img {
    max-height: 400px;
    object-fit: cover;
  }

  .berita-content p {
    line-height: 1.8;
    margin-bottom: 16px;
    text-align: justify;
  }
</style>
@endsection