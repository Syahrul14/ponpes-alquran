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
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Sejarah</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Napak tilas perjuangan, visi, dan nilai-nilai luhur berdirinya Ponpes Al-Qur'an Rizky Amalia.</p>
            </div>
        </div>
    </div>
</section>

<section id="sejarah-detail" class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative ps-4 pb-4">
                    <div class="position-absolute bottom-0 start-0 bg-success-subtle rounded-3" style="width: 85%; height: 85%; z-index: 1;"></div>
                    
                    <img src="{{ asset('assets/images/home/home_banner_1.jpg') }}" 
                         alt="Gedung Ponpes Al-Quran Rizky Amalia" 
                         class="img-fluid rounded-3 shadow-lg position-relative" 
                         style="z-index: 2; object-fit: cover; width: 100%; max-height: 400px;">
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="align-self-center">
                    <span class="text-success fw-bold text-uppercase tracking-wider small d-block mb-2">Awal Mula Perjalanan</span>
                    <h2 class="fw-bold text-dark mb-4">Membangun Generasi Qur'ani Sejak Awal Berdiri</h2>

                    <div class="sejarah-body text-secondary">
                      <p>
                          Pondok Pesantren Al-Qur'an Rizky Amalia didirikan atas dasar ketulusan niat dan kepedulian yang mendalam terhadap kualitas pendidikan agama generasi muda. Berawal dari sebuah majelis ta'lim sederhana yang diprakarsai oleh para pendiri, pesantren ini berkomitmen penuh untuk melahirkan huffadz (penghafal Al-Qur'an) yang tidak hanya unggul dalam hafalan, tetapi juga matang dalam berakhlak mulia.
                      </p>
                      
                      <p>
                          Seiring berjalannya waktu, dukungan dari para tokoh masyarakat, alumni, dan para wali santri terus mengalir. Hal ini memicu transformasi besar hingga majelis kecil tersebut berkembang menjadi institusi pendidikan formal dan informal terpadu seperti sekarang, yang menyediakan fasilitas representatif bagi santri dari berbagai penjuru wilayah.
                      </p>
                    </div>

                    <div class="border-start border-4 border-success ps-3 my-4 py-1 bg-light rounded-end">
                        <p class="fst-italic text-dark mb-1 fw-medium">"Menjadikan Al-Qur'an sebagai pemandu jalan hidup, serta membentuk santri yang mandiri, cerdas, dan siap mengabdi untuk umat."</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection