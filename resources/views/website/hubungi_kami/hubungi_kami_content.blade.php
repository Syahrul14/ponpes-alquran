@extends('website.layout')

@section('title', 'Hubungi Kami')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ !empty($globalPageBanner?->image) ? asset('storage/' . $globalPageBanner->image) : asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
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
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark">Hubungi Kami</h2>
            <p class="text-muted">Silakan hubungi kami untuk informasi pendaftaran, konsultasi, atau informasi lainnya</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" data-aos="fade-up">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" data-aos="fade-up">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" data-aos="fade-up">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-circle me-1"></i> Mohon lengkapi formulir dengan benar:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            
            <!-- Form Kirim Pesan -->
            <div class="col-lg-7" data-aos="fade-up">
                <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 h-100">
                    <h5 class="fw-bold mb-3 text-dark">Kirimkan Pesan Anda</h5>
                    <form action="{{ route('website.contact.send') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label fw-semibold">Subjek Pesan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Contoh: Pertanyaan Syarat Pendaftaran Santri" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-semibold">Isi Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tuliskan pertanyaan atau pesan Anda secara lengkap..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Kontak -->
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 h-100">
                    
                    <h5 class="fw-bold mb-4 text-dark">Informasi Kontak</h5>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                            <i class="bi bi-geo-alt-fill fs-5"></i>
                        </div>
                        <div>
                            <strong class="text-dark d-block">Alamat Pesantren</strong>
                            <p class="mb-0 text-muted small">Jl. Contoh No.123, Kabupaten/Kota, Indonesia</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                            <i class="bi bi-telephone-fill fs-5"></i>
                        </div>
                        <div>
                            <strong class="text-dark d-block">Telepon / WhatsApp</strong>
                            <p class="mb-0 text-muted small">0812-3456-7890</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                            <i class="bi bi-envelope-fill fs-5"></i>
                        </div>
                        <div>
                            <strong class="text-dark d-block">Email Resmi</strong>
                            <p class="mb-0 text-muted small">info@ponpes.com</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                            <i class="bi bi-clock-fill fs-5"></i>
                        </div>
                        <div>
                            <strong class="text-dark d-block">Jam Pelayanan Kantor</strong>
                            <p class="mb-0 text-muted small">Senin - Sabtu (08:00 - 16:00 WIB)</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Google Maps Embed -->
        <div class="mt-5" data-aos="fade-up">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.97085556088!2d110.33364489021656!3d-7.803248457435839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a582c7e459e7b%3A0x5701c5404fb7a847!2sLempuyangan!5e0!3m2!1sen!2sid!4v1781430015998!5m2!1sen!2sid"
                    width="100%" 
                    height="350" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>

    </div>
</section>
@endsection

