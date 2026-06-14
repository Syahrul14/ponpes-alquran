@extends('website.layout')

@section('title', 'Fasilitas')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Fasilitas</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section class="fasilitas py-5 bg-light">
  <div class="container">
    
    <!-- Title -->
    <div class="text-center mb-5">
      <h2 class="fw-bold">Fasilitas</h2>
      <p class="text-muted">Fasilitas terbaik untuk kenyamanan dan pembelajaran</p>
    </div>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="fasilitas-card">
          <div class="fasilitas-img">
            <img src="{{ asset('assets/images/fasilitas/masjid.jpg') }}" alt="Masjid">
          </div>
          <div class="p-4 text-center">
            <h5 class="fw-bold">Masjid</h5>
            <p class="text-muted">Tempat ibadah yang nyaman dan luas</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="fasilitas-card">
          <div class="fasilitas-img">
            <img src="{{ asset('assets/images/fasilitas/asrama.jpeg') }}" alt="Asrama">
          </div>
          <div class="p-4 text-center">
            <h5 class="fw-bold">Asrama</h5>
            <p class="text-muted">Asrama bersih dan aman</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="fasilitas-card">
          <div class="fasilitas-img">
            <img src="{{ asset('assets/images/fasilitas/perpus.jpg') }}" alt="Perpustakaan">
          </div>
          <div class="p-4 text-center">
            <h5 class="fw-bold">Perpustakaan</h5>
            <p class="text-muted">Koleksi buku lengkap</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
  .fasilitas-card {
  background: #fff;
  border-radius: 15px;
  overflow: hidden;
  transition: 0.3s;
  box-shadow: 0 10px 25px rgba(0,0,0,0.05);
  height: 100%;
}

.fasilitas-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.fasilitas-img {
  overflow: hidden;
  height: 220px;
}

.fasilitas-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.4s;
}

.fasilitas-card:hover img {
  transform: scale(1.1);
}
</style>
@endsection
