@extends('website.layout')

@section('title', 'Beranda')

@section('content')

<section id="hero">
  <div id="heroCarousel"
       class="carousel slide carousel-fade"
       data-bs-ride="carousel"
       data-bs-interval="2000">

    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="hero-slide"
             style="background-image: url('{{ asset('assets/images/home/home_banner_1.jpg') }}');">
        </div>
      </div>
      <div class="carousel-item">
        <div class="hero-slide"
             style="background-image: url('{{ asset('assets/images/home/home_banner_2.jpeg') }}');">
        </div>
      </div>
      <div class="carousel-item">
        <div class="hero-slide"
             style="background-image: url('{{ asset('assets/images/home/home_banner_3.jpg') }}');">
        </div>
      </div>

    </div>

    <div class="hero-content text-white text-center px-3">

      <h1 class="fw-bold mb-3 display-6 display-md-4">
        Pondok Pesantren Al-Qur'an Rizky Amalia
      </h1>

      <p class="mb-4 fs-6 fs-md-5 mx-auto" style="max-width: 700px;">
        Mencetak generasi Qurani yang berakhlak mulia, berilmu, dan siap menghadapi tantangan zaman.
      </p>

      <a href="#daftar" class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
        Daftar Sekarang
      </a>

    </div>

    <!-- ARROW CONTROL -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</section>

<section id="about" class="py-5 bg-light">

  <div class="container">

    <div class="row align-items-center g-4">
      <div class="col-lg-6 d-flex">
        <img src="{{ asset('assets/images/home/sejarah.jpeg') }}"
             class="img-fluid about-img"
             alt="Sejarah">
      </div>
      <div class="col-lg-6">
        <div class="sejarah-wrap">
          <h2 class="fw-bold text-success display-5 mb-2">
            Pesantren Al-Qur'an Rizky Amalia
          </h2>
          <div class="about-text mt-4">
            <div class="text-muted fs-6 lh-lg about-content">
              <p>
                <strong>Pesantren Al-Qur'an Rizky Amalia</strong> tidak bisa lepas dari tokoh ulama Indonesia yang memiliki visi besar dalam pendidikan Islam.
              </p>
              <p>
                Selang dua dekade, tepatnya tahun 1991, semangatnya membangun umat mendorong untuk mendirikan pondok pesantren baru yang menjadi pusat pendidikan Al-Qur'an.
              </p>
            </div>
          </div>
          <a href="sejarah"
            class="btn btn-success rounded-pill px-4 mt-3">
            Selengkapnya
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="testimonials" class="testimonials section-bg">
  <div class="container aos-init aos-animate" data-aos="fade-up">
    <div class="section-header text-secondary">
        <h2>Kata Mereka</h2>
        <p>Melalui jejaring alumni, kami bertanya terkait kesan mereka pesantren di Ponpes Al-Qur'an Rizky Amalia. Berikut ini pernyataan dari Alumni.</p>
    </div>
    <div id="carouselAlumni" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
      
      <div class="carousel-inner">
        
        <div class="carousel-item active">
          <div class="card border-0 shadow-sm mx-auto my-3" style="max-width: 600px; border-radius: 15px;">
            <div class="card-body p-4 text-center">
              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" class="rounded-circle mb-3 border border-3 border-success-subtle" alt="Foto Alumni" style="width: 80px; height: 80px; object-fit: cover;">
              <h5 class="card-title fw-bold mb-1">Ahmad Fauzi</h5>
              <p class="text-muted small mb-3">Kepala Sekolah SDN 1 Timur</p>
              <p class="card-text text-secondary" style="font-style: italic;">"Belajar di Ponpes Rizky Amalia memberikan saya fondasi agama yang kuat dan lingkungan yang sangat mendukung untuk menghafal Al-Qur'an."</p>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="card border-0 shadow-sm mx-auto my-3" style="max-width: 600px; border-radius: 15px;">
            <div class="card-body p-4 text-center">
              <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&h=100&fit=crop" class="rounded-circle mb-3 border border-3 border-success-subtle" alt="Foto Alumni" style="width: 80px; height: 80px; object-fit: cover;">
              <h5 class="card-title fw-bold mb-1">Siti Nurhaliza</h5>
              <p class="text-muted small mb-3">Manager PT Xyz</p>
              <p class="card-text text-secondary" style="font-style: italic;">"Metode pembelajaran tahfidznya sangat sistematis. Para pengajar sangat sabar dan membimbing kami hingga benar-benar mutqin."</p>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="card border-0 shadow-sm mx-auto my-3" style="max-width: 600px; border-radius: 15px;">
            <div class="card-body p-4 text-center">
              <img src="https://images.unsplash.com/photo-1780570589435-059359e813cc?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-circle mb-3 border border-3 border-success-subtle" alt="Foto Alumni" style="width: 80px; height: 80px; object-fit: cover;">
              <h5 class="card-title fw-bold mb-1">Muhammad Rizky</h5>
              <p class="text-muted small mb-3">Pengusaha</p>
              <p class="card-text text-secondary" style="font-style: italic;">"Bukan hanya sekadar menghafal, kami juga diajarkan bagaimana mengamalkan nilai-nilai Al-Qur'an dalam kehidupan bermasyarakat."</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<style>

  #hero,
  #heroCarousel,
  #hero .carousel-inner,
  #hero .carousel-item {
      height: 100vh;
  }

  .hero-slide {
      height: 100vh;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
  }

  .hero-slide::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
      z-index: 1;
  }

  .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);

      z-index: 2;
      max-width: 700px;
      padding: 0 20px;
  }

  .carousel-control-prev,
  .carousel-control-next {
      z-index: 5;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
      filter: invert(1);
      width: 3rem;
      height: 3rem;
  }

  .hero-content {
      width: 100%;
      padding: 0 15px;
  }

  .about-img {
      transition: transform 0.3s ease;
  }

  .about-img:hover {
      transform: scale(1.03);
  }

  .sejarah-wrap {
      padding-left: 20px;
      border-left: 4px solid #198754;
  }

  .sejarah-wrap h2 {
      letter-spacing: -0.5px;
  }

  .sejarah-wrap p {
      margin-bottom: 12px;
  }

  .about-content p {
      margin-bottom: 14px;
      line-height: 1.8;
      color: #6c757d;
  }

  .about-content p:first-child {
      margin-top: 0;
  }

  .about-content strong {
      color: #198754;
  }

  .section-bg {
      background-color: #f5f6f7;
  }

  .testimonials {
      padding: 80px 0;
      overflow: hidden;
  }

  .section-header {
      text-align: center;
      padding: 0 20px 40px 20px;
  }

  .section-header h2 {
      font-size: clamp(22px, 4vw, 32px); 
      font-weight: 700;
      color: #2e3135;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
  }

  .section-header h2::before,
  .section-header h2::after {
      content: "";
      width: 40px;
      height: 2px;
      background: #198754;
      flex-shrink: 0;
  }

  .section-header p {
      font-size: clamp(14px, 2.5vw, 16px);
      color: #6c757d;
      max-width: 650px;
      margin: 0 auto;
      line-height: 1.6;
  }

  #carouselAlumni .carousel-item {
      height: auto !important;
      min-height: initial !important;
  }

@media (max-width: 576px) {
    .hero-content h1 {
        font-size: 1.6rem;
        line-height: 1.3;
    }

    .hero-content p {
        font-size: 0.95rem;
        margin-bottom: 20px;
    }

    .hero-content .btn {
        width: 100%;
        max-width: 250px;
    }
}
</style>

@endsection