@extends('website.layout')

@section('title', 'Infaq')

@section('content')
<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ !empty($globalPageBanner?->image) ? asset('storage/' . $globalPageBanner->image) : asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
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
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Infaq Transfer Bank</h2>
      <p class="text-muted">
        Salurkan infaq Anda melalui rekening resmi pondok pesantren berikut
      </p>
    </div>

    <!-- Main Card -->
    <div class="col-lg-7 mx-auto" data-aos="fade-up">
      <div class="bg-white shadow-sm rounded-4 p-4">

        @forelse ($bankTransfers as $index => $item)
          <!-- Item -->
          <div class="d-flex align-items-center justify-content-between py-3 {{ !$loop->last ? 'border-bottom' : '' }} bank-item px-2">
            <div class="d-flex align-items-center gap-3">
              @if ($item->logo_bank)
                <img src="{{ asset('storage/' . $item->logo_bank) }}" 
                     alt="{{ $item->bank_name }}" 
                     style="height:40px; max-width:120px; object-fit:contain;">
              @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded p-2" style="width:45px; height:40px;">
                  <i class="bi bi-bank fs-4 text-secondary"></i>
                </div>
              @endif
              <div>
                <div class="fw-bold text-dark">{{ $item->bank_name }}</div>
                <small class="text-muted">{{ $item->account_name }}</small>
              </div>
            </div>
            <div class="text-end">
              <div class="fw-semibold text-dark">{{ $item->account_number }}</div>
              <button class="btn btn-sm btn-outline-success mt-1" onclick="copyText('{{ $item->account_number }}', this)">
                <i class="bi bi-clipboard me-1"></i> <span>Salin</span>
              </button>
            </div>
          </div>
        @empty
          <div class="text-center py-4 text-muted">
            <i class="bi bi-bank display-6 d-block mb-2 text-secondary"></i>
            Belum ada rekening transfer yang tersedia.
          </div>
        @endforelse

      </div>
    </div>

    <!-- Note -->
    <div class="text-center mt-4">
      <p class="text-muted small">
        * Setelah melakukan transfer, mohon simpan bukti transfer Anda untuk konfirmasi jika diperlukan.
      </p>
    </div>

  </div>
</section>

<section class="qris-section py-5 bg-white">
  <div class="container">

    <!-- Title -->
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Infaq via QRIS</h2>
      <p class="text-muted">
        Scan QRIS di bawah ini untuk menyalurkan infaq dengan mudah dan cepat
      </p>
    </div>

    <!-- QR Card -->
    <div class="col-lg-5 mx-auto text-center" data-aos="fade-up">
      <div class="card border-0 shadow-sm rounded-4 p-4">

        <!-- QR Image -->
        <div class="mb-3">
          @if ($qris && $qris->image)
            <img src="{{ asset('storage/' . $qris->image) }}" 
                 alt="{{ $qris->title ?? 'QRIS' }}" class="img-fluid rounded" style="max-width:250px;">
          @else
            <img src="{{ asset('assets/images/infaq/qris.jpeg') }}" 
                 alt="QRIS" class="img-fluid rounded" style="max-width:250px;">
          @endif
        </div>

        <!-- Label -->
        <h5 class="fw-bold mb-1">{{ $qris->title ?? 'QRIS Yayasan' }}</h5>
        <small class="text-muted">{{ $qris->description ?? 'Mendukung semua e-wallet & mobile banking' }}</small>

        <!-- Info -->
        <div class="mt-3 text-muted small">
          <p class="mb-1">✔ OVO, GoPay, DANA, ShopeePay</p>
          <p class="mb-0">✔ Semua Mobile Banking (BCA, Mandiri, BRI, BSI, dll)</p>
        </div>

      </div>
    </div>

    <!-- Note -->
    <div class="text-center mt-4">
      <p class="text-muted small">
        {{ $qris->note ?? '* Setelah melakukan pembayaran, mohon simpan bukti transaksi Anda.' }}
      </p>
    </div>

  </div>
</section>

<script>
  function copyText(text, btn) {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(text).then(() => {
        if (btn) {
          const originalHtml = btn.innerHTML;
          btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Tersalin!';
          btn.classList.remove('btn-outline-success');
          btn.classList.add('btn-success');
          setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-success');
          }, 2000);
        }
      });
    } else {
      const tempInput = document.createElement('input');
      tempInput.value = text;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      if (btn) {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Tersalin!';
        setTimeout(() => {
          btn.innerHTML = originalHtml;
        }, 2000);
      }
    }
  }
</script>

<style>
  .bank-transfer .bank-item {
    transition: background-color 0.2s ease, border-radius 0.2s ease;
  }

  .bank-transfer .bank-item:hover {
    background-color: #f8f9fa;
    border-radius: 8px;
  }

  .qris-section .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .qris-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(0,0,0,0.08) !important;
  }
</style>
@endsection

