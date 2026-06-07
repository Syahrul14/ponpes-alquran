@extends('website.layout')

@section('title', 'Program')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Program</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section class="program py-5 bg-light">
    <div class="container py-4">
        
        <div class="row g-4 justify-content-center">
            
            <!-- Card 1: Tahfidz Al-Qur'an -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm overflow-hidden program-card">
                    <div style="height: 240px; overflow: hidden;">
                        <img src="{{ asset('assets/images/program/tafizquran.jpeg') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="Tahfidz Al-Qur'an">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold text-dark mb-2">Tahfidz Al-Qur'an</h4>
                        <p class="card-text text-muted mb-0">Program akselerasi menghafal Al-Qur'an dengan metode talaqqi dan murojaah yang terstruktur untuk mencetak hafizh berkarakter.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Madrasah Diniyah -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm overflow-hidden program-card">
                    <div style="height: 240px; overflow: hidden;">
                        <img src="{{ asset('assets/images/program/madrasah.jpeg') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="Madrasah Diniyah">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold text-dark mb-2">Madrasah Diniyah</h4>
                        <p class="card-text text-muted mb-0">Pendalaman kitab kuning, fiqih, aqidah akhlak, serta tata bahasa Arab (Nahwu & Sharaf) untuk memperkokoh pondasi ilmu syar'i.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Kajian Kitab & Dakwah -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm overflow-hidden program-card">
                    <div style="height: 240px; overflow: hidden;">
                        <img src="{{ asset('assets/images/program/dakwah.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover" alt="Kajian Kitab & Dakwah">
                    </div>
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold text-dark mb-2">Kajian & Dakwah</h4>
                        <p class="card-text text-muted mb-0">Pelatihan khitabah (pidato), kepemimpinan, dan pengabdian masyarakat guna mempersiapkan santri yang siap terjun berdakwah.</p>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</section>

<!-- CSS Tambahan untuk Efek Animasi Kartu -->
<style>
    .program-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .program-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08) !important;
    }
    .program-card img {
        transition: transform 0.5s ease;
    }
    .program-card:hover img {
        transform: scale(1.05);
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
