@extends('website.layout')

@section('title', 'Hubungi-Kami')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Hubungi Kami</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section class="hubungi-kami py-5 bg-light">
    <div class="container">
        
        <!-- Title -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Hubungi Kami</h2>
            <p class="text-muted">Silakan hubungi kami untuk informasi lebih lanjut</p>
        </div>

        <div class="row g-4">
            
            <!-- Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subjek</label>
                                <input type="text" class="form-control" placeholder="Subjek pesan">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="5" placeholder="Tulis pesan anda..."></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger w-100 fw-bold">
                                    Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Kontak -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 h-100">
                    
                    <h5 class="fw-bold mb-4">Informasi Kontak</h5>

                    <div class="d-flex mb-3">
                        <i class="fas fa-map-marker-alt me-3 text-danger"></i>
                        <div>
                            <strong>Alamat</strong>
                            <p class="mb-0 text-muted">Jl. Contoh No.123, XXX, XXX</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <i class="fas fa-phone-alt me-3 text-danger"></i>
                        <div>
                            <strong>Telepon</strong>
                            <p class="mb-0 text-muted">0812-3456-7890</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <i class="fas fa-envelope me-3 text-danger"></i>
                        <div>
                            <strong>Email</strong>
                            <p class="mb-0 text-muted">info@ponpes.com</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <i class="fas fa-clock me-3 text-danger"></i>
                        <div>
                            <strong>Jam Operasional</strong>
                            <p class="mb-0 text-muted">Senin - Jumat (08:00 - 16:00)</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Map -->
        <div class="mt-5">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.97085556088!2d110.33364489021656!3d-7.803248457435839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a582c7e459e7b%3A0x5701c5404fb7a847!2sLempuyangan!5e0!3m2!1sen!2sid!4v1781430015998!5m2!1sen!2sid"
                width="100%" 
                height="350" 
                style="border:0; border-radius: 10px;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

    </div>
</section>
@endsection
