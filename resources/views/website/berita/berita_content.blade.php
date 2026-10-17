@extends('website.layout')

@section('title', 'Berita')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ !empty($globalPageBanner?->image) ? asset('storage/' . $globalPageBanner->image) : asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
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

<section class="py-5 bg-light">
  <div class="container">

    <div class="row g-4">

      @forelse ($newsList as $index => $item)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
          <div class="card berita-card border-0 shadow-sm h-100">
            <div class="overflow-hidden">
              <img src="{{ !empty($item->image) ? asset('storage/' . $item->image) : asset('assets/images/home/home_banner_3.jpg') }}" 
                   class="card-img-top berita-img w-100" 
                   alt="{{ $item->title }}">
            </div>
            <div class="card-body d-flex flex-column p-4">
              <small class="text-muted mb-2">
                <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
              </small>
              <h5 class="fw-bold mb-2">
                <a href="{{ route('website.berita.detail', $item->slug) }}" class="text-dark text-decoration-none hover-success">
                  {{ $item->title }}
                </a>
              </h5>
              <p class="text-muted small flex-grow-1">
                {{ Str::limit(strip_tags($item->content), 120) }}
              </p>
              <a href="{{ route('website.berita.detail', $item->slug) }}" class="btn btn-sm btn-success mt-2 align-self-start">
                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <div class="text-muted">
            <i class="bi bi-newspaper display-4 d-block mb-3 text-secondary"></i>
            <h5>Belum ada berita yang dipublikasikan.</h5>
          </div>
        </div>
      @endforelse

    </div>

  </div>
</section>

<style>
  .berita-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .berita-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important;
  }

  .berita-img {
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .berita-card:hover .berita-img {
    transform: scale(1.08);
  }

  .hover-success:hover {
    color: #198754 !important;
  }
</style>
@endsection

