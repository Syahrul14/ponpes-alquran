@extends('website.layout')

@section('title', 'Infaq')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">Infaq</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">Ponpes Al-Qur'an Rizky Amalia</p>
            </div>
        </div>
    </div>
</section>

<section class="bank-transfer py-5 bg-light">
  <div class="container">

    <!-- Title -->
    <div class="text-center mb-5">
      <h2 class="fw-bold">Infaq Transfer Bank</h2>
      <p class="text-muted">
        Salurkan infaq Anda melalui rekening resmi berikut
      </p>
    </div>

    <!-- Main Card -->
    <div class="col-lg-7 mx-auto">
      <div class="bg-white shadow-sm rounded-4 p-4">

        <!-- Item -->
        <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
          <div class="d-flex align-items-center gap-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" 
                 alt="BCA" style="height:40px; width:auto;">
            <div>
              <div class="fw-bold">Bank BCA</div>
              <small class="text-muted">a.n Yayasan Al-Quran</small>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-semibold">1234567890</div>
            <button class="btn btn-sm btn-outline-primary mt-1" onclick="copyText('1234567890')">
              Salin
            </button>
          </div>
        </div>

        <!-- Item -->
        <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
          <div class="d-flex align-items-center gap-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" 
                 alt="Mandiri" style="height:40px;">
            <div>
              <div class="fw-bold">Bank Mandiri</div>
              <small class="text-muted">a.n Yayasan Al-Quran</small>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-semibold">9876543210</div>
            <button class="btn btn-sm btn-outline-primary mt-1" onclick="copyText('9876543210')">
              Salin
            </button>
          </div>
        </div>

        <!-- Item -->
        <div class="d-flex align-items-center justify-content-between py-3">
          <div class="d-flex align-items-center gap-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/02/Bank_BRI_2000.svg" 
                 alt="BRI" style="height:40px;">
            <div>
              <div class="fw-bold">Bank BRI</div>
              <small class="text-muted">a.n Yayasan Al-Quran</small>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-semibold">1122334455</div>
            <button class="btn btn-sm btn-outline-primary mt-1" onclick="copyText('1122334455')">
              Salin
            </button>
          </div>
        </div>

      </div>
    </div>

    <!-- Note -->
    <div class="text-center mt-4">
      <p class="text-muted small">
        * Setelah transfer, mohon konfirmasi ke admin kami.
      </p>
    </div>

  </div>
</section>

<section class="qris-section py-5 bg-white">
  <div class="container">

    <!-- Title -->
    <div class="text-center mb-5">
      <h2 class="fw-bold">Infaq via QRIS</h2>
      <p class="text-muted">
        Scan QRIS di bawah ini untuk menyalurkan infaq dengan mudah
      </p>
    </div>

    <!-- QR Card -->
    <div class="col-lg-5 mx-auto text-center">
      <div class="card border-0 shadow-sm rounded-4 p-4">

        <!-- QR Image -->
        <div class="mb-3">
          <img src="{{ asset('assets/images/infaq/qris.jpeg') }}" 
               alt="QRIS" class="img-fluid" style="max-width:250px;">
        </div>

        <!-- Label -->
        <h5 class="fw-bold mb-1">QRIS Yayasan</h5>
        <small class="text-muted">Mendukung semua e-wallet & mobile banking</small>

        <!-- Info -->
        <div class="mt-3 text-muted small">
          <p class="mb-1">✔ OVO, GoPay, DANA, ShopeePay</p>
          <p class="mb-0">✔ Semua Mobile Banking</p>
        </div>

      </div>
    </div>

    <!-- Note -->
    <div class="text-center mt-4">
      <p class="text-muted small">
        * Setelah melakukan pembayaran, mohon simpan bukti transaksi.
      </p>
    </div>

  </div>
</section>

<script>
  function copyText(text) {
    navigator.clipboard.writeText(text);
  }
</script>

<style>
  .bank-transfer .bg-white > div:hover {
    background: #f8f9fa;
    border-radius: 10px;
    transition: 0.3s;
  }

  .qris-section .card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
  }
</style>

@endsection
