@extends('website.layout')

@section('title', $informasi->title . ' - Detail Informasi')

@section('content')

<!-- HERO -->
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ !empty($globalPageBanner?->image) ? asset('storage/' . $globalPageBanner->image) : asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5 text-center" style="z-index: 2;" data-aos="fade-up">
        <h1 class="fw-bold display-5">Detail Informasi</h1>
        <p class="text-white-50">Ponpes Al-Qur'an Rizky Amalia</p>
    </div>
</section>

<!-- CONTENT -->
<section class="py-5 bg-light">
  <div class="container">

    <div class="row g-4 justify-content-center">
      
      <!-- MAIN ARTICLE -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm informasi-detail overflow-hidden">

          <!-- IMAGE -->
          @if ($informasi->image)
            <img src="{{ asset('storage/' . $informasi->image) }}" 
                 class="img-fluid w-100 informasi-detail-img" 
                 alt="{{ $informasi->title }}">
          @endif

          <!-- BODY -->
          <div class="card-body p-4 p-md-5">

            <!-- DATE -->
            <small class="text-muted d-block mb-3">
              <i class="bi bi-calendar3 me-1"></i> {{ $informasi->created_at ? $informasi->created_at->format('d M Y') : '-' }}
            </small>

            <!-- TITLE -->
            <h2 class="fw-bold mb-4 text-dark">
              {{ $informasi->title }}
            </h2>

            <hr class="my-4 text-muted opacity-25">

            <!-- CONTENT -->
            <div class="informasi-content text-muted lh-lg">
              {!! $informasi->content !!}
            </div>

            <hr class="my-4 text-muted opacity-25">

            <!-- BACK BUTTON -->
            <a href="{{ route('website.informasi') }}" class="btn btn-outline-success mt-2">
              <i class="bi bi-arrow-left me-1"></i> Kembali ke Informasi
            </a>

          </div>

        </div>
      </div>

      <!-- SIDEBAR (INFORMASI TERBARU) -->
      @if (isset($recentInformasi) && $recentInformasi->count() > 0)
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 100px; border-radius: 12px;">
            <h5 class="fw-bold mb-3 pb-2 border-bottom border-success border-2">Informasi Terbaru</h5>
            
            <div class="d-flex flex-column gap-3">
              @foreach ($recentInformasi as $recent)
                <div class="d-flex gap-3 align-items-center">
                  @if ($recent->image)
                    <img src="{{ asset('storage/' . $recent->image) }}" 
                         alt="{{ $recent->title }}" 
                         class="rounded shadow-sm flex-shrink-0" 
                         style="width: 80px; height: 60px; object-fit: cover;">
                  @endif
                  <div>
                    <h6 class="mb-1">
                      <a href="{{ route('website.informasi.detail', $recent->slug) }}" class="text-dark text-decoration-none hover-success small fw-semibold line-clamp-2">
                        {{ $recent->title }}
                      </a>
                    </h6>
                    <small class="text-muted" style="font-size: 0.75rem;">
                      <i class="bi bi-calendar3 me-1"></i> {{ $recent->created_at ? $recent->created_at->format('d M Y') : '-' }}
                    </small>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      @endif

    </div>

  </div>
</section>

<style>
  .informasi-detail {
    border-radius: 12px;
  }

  .informasi-detail-img {
    max-height: 440px;
    object-fit: cover;
  }

  .informasi-content p {
    line-height: 1.85;
    margin-bottom: 1.25rem;
  }

  .hover-success:hover {
    color: #198754 !important;
  }

  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>
@endsection

