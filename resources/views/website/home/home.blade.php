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

<style>

  #hero,
  #heroCarousel,
  .carousel-inner,
  .carousel-item {
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