@extends('website.layout')

@section('title', 'Detail Informasi')

@section('content')

<!-- HERO -->
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5 text-center" style="z-index: 2;" data-aos="fade-up">
        <h1 class="fw-bold display-5">Detail Informasi</h1>
        <p class="text-white-50">Ponpes Al-Qur'an Rizky Amalia</p>
    </div>
</section>

<!-- DETAIL -->
<section class="informasi-detail py-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Judul -->
                <h2 class="fw-bold mb-3">
                    Kegiatan Santri Bulan Ini
                </h2>

                <!-- Meta -->
                <div class="mb-4 text-muted">
                    <small>
                        <i class="fas fa-calendar-alt me-1"></i> 10 Juni 2026
                    </small>
                </div>

                <!-- Thumbnail -->
                <img src="{{ asset('assets/images/home/home_banner_3.jpg') }}" 
                     class="img-fluid rounded mb-4 shadow-sm" 
                     style="max-height: 400px; width: 100%; object-fit: cover;">

                <!-- Content -->
                <div class="content text-muted" style="line-height: 1.8;">
                    <p>
                        Diberitahukan kepada seluruh santri dan wali santri Ponpes Al-Qur'an Rizky Amalia, 
                        bahwa akan dilaksanakan kegiatan evaluasi pembelajaran bulanan yang bertujuan untuk 
                        meningkatkan kualitas pendidikan dan kedisiplinan santri.
                    </p>

                    <p>
                        Sehubungan dengan hal tersebut, diharapkan seluruh santri dapat mempersiapkan diri 
                        dengan baik dan mengikuti kegiatan sesuai dengan jadwal yang telah ditentukan. 
                        Adapun jadwal pelaksanaan akan diinformasikan lebih lanjut melalui pengurus pondok.
                    </p>

                    <p>
                        Demikian pengumuman ini disampaikan. Atas perhatian dan kerjasamanya kami ucapkan 
                        terima kasih.
                    </p>
                </div>

                <!-- Back Button -->
                <div class="mt-5">
                    <a href="#" class="btn btn-outline-danger">
                        ← Kembali ke Informasi
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection