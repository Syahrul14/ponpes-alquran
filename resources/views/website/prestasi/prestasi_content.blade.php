@extends('website.layout')

@section('title', 'Prestasi')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ !empty($globalPageBanner?->image) ? asset('storage/' . $globalPageBanner->image) : asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Prestasi</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION PRESTASI -->
<section class="prestasi py-5 bg-light">
    <div class="container py-4">
        
        <div class="row g-4 justify-content-center">
            @foreach ($data['prestasi_cards'] as $index => $item)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden achievement-card">
                        <div style="height: 240px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 class="card-img-top w-100 h-100 object-fit-cover" 
                                 alt="{{ $item->title }}">
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $item->title }}</h5>
                            <p class="card-text text-muted small mb-0">{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CSS Kustom untuk Tampilan Modern & Elegan -->
<style>
    .achievement-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        outline: 0 solid transparent;
    }
    .achievement-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 2.5rem rgba(25, 135, 84, 0.12) !important;
        outline: 2px solid #198754;
    }
    .achievement-card img {
        transition: transform 0.6s ease;
    }
    .achievement-card:hover img {
        transform: scale(1.06);
    }
    .tracking-wider {
        letter-spacing: 1px;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>

@endsection

