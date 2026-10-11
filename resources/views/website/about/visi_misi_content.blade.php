@extends('website.layout')

@section('title', 'Sejarah')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Visi & Misi</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section id="visi" class="py-5 bg-white">
    <div class="container">

        <div class="row justify-content-center text-center mb-5" data-aos="fade-up">
            <div class="col-lg-8">
                <h2 class="fw-bold text-success mb-3">Visi & Misi</h2>
                <p class="text-muted">
                    Landasan dan arah dalam membentuk generasi Qurani yang berakhlak mulia dan berprestasi.
                </p>
            </div>
        </div>

        <div class="row g-4">

            <!-- VISI -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="p-4 shadow-sm h-100 rounded-4 border-start border-4 border-success bg-light">
                    
                    <h4 class="fw-bold text-success mb-3">
                        <i class="fas fa-bullseye me-2"></i> Visi
                    </h4>

                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        Menjadi lembaga pendidikan Islam yang unggul dalam mencetak generasi 
                        penghafal Al-Qur’an yang berakhlak mulia, berilmu, dan mampu bersaing di era global.
                    </p>

                </div>
            </div>

            <!-- MISI -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="p-4 shadow-sm h-100 rounded-4 border-start border-4 border-success bg-light">
                    
                    <h4 class="fw-bold text-success mb-3">
                        <i class="fas fa-tasks me-2"></i> Misi
                    </h4>

                    <ul class="text-muted ps-3 mb-0" style="line-height: 1.8;">
                        <li>Menyelenggarakan pendidikan berbasis Al-Qur’an secara intensif.</li>
                        <li>Membentuk karakter santri yang disiplin dan berakhlak islami.</li>
                        <li>Mengembangkan potensi akademik dan non-akademik santri.</li>
                        <li>Menanamkan nilai kemandirian dan tanggung jawab.</li>
                        <li>Mempersiapkan generasi yang siap menghadapi tantangan zaman.</li>
                    </ul>

                </div>
            </div>

        </div>

    </div>
</section>

<style>
  #visi .shadow-sm {
      transition: all 0.3s ease;
  }

  #visi .shadow-sm:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
</style>
@endsection
