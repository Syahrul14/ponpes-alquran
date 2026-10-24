@extends('administrator.layout')
@section('content_title', 'Pengaturan QRIS Infaq')

@section('content')
@if (session('success'))
  <div class="alert alert-success alert-dismissible show fade">
    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible show fade">
    <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible show fade">
    <ul class="mb-0">
      @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="row">
    <!-- Kolom Preview QRIS -->
    <div class="col-md-5 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">Preview Tampilan QRIS</h5>
            </div>
            <div class="card-body text-center d-flex flex-column align-items-center justify-content-center p-4">
                <div class="border rounded-4 p-3 bg-white shadow-sm mb-3" style="max-width: 280px; width: 100%;">
                    @if ($data && $data->image)
                        <img id="preview_img" src="{{ asset('storage/' . $data->image) }}" alt="QRIS" class="img-fluid rounded" style="max-height: 250px; width: auto;">
                    @else
                        <img id="preview_img" src="{{ asset('assets/images/infaq/qris.jpeg') }}" alt="QRIS" class="img-fluid rounded" style="max-height: 250px; width: auto;">
                    @endif
                </div>
                <h5 class="fw-bold mb-1 text-dark" id="preview_title">{{ $data->title ?? 'QRIS Yayasan' }}</h5>
                <small class="text-muted mb-3" id="preview_desc">{{ $data->description ?? 'Mendukung semua e-wallet & mobile banking' }}</small>
                
                <div class="bg-light p-3 rounded-3 text-start w-100 small text-muted">
                    <p class="mb-1 fw-semibold text-dark">Informasi Sistem:</p>
                    <p class="mb-1">✔ OVO, GoPay, DANA, ShopeePay</p>
                    <p class="mb-0">✔ Semua Mobile Banking (BCA, Mandiri, BRI, dll)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Form Edit QRIS -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">Ubah Barcode & Informasi QRIS</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.infaq_qris.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload File Barcode QRIS @if(!$data) <span class="text-danger">*</span> @endif</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar barcode QRIS. Maksimal 20MB (JPG, PNG, WEBP).</small>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Nama / Label QRIS <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $data->title ?? 'QRIS Yayasan') }}" placeholder="Contoh: QRIS Yayasan / QRIS Ponpes" required oninput="document.getElementById('preview_title').innerText = this.value">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Keterangan Singkat</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $data->description ?? 'Mendukung semua e-wallet & mobile banking') }}" placeholder="Contoh: Mendukung semua e-wallet & mobile banking" oninput="document.getElementById('preview_desc').innerText = this.value">
                    </div>

                    <div class="mb-4">
                        <label for="note" class="form-label">Catatan Konfirmasi Pembayaran</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="* Setelah melakukan pembayaran, mohon simpan bukti transaksi Anda.">{{ old('note', $data->note ?? '* Setelah melakukan pembayaran, mohon simpan bukti transaksi Anda.') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Pengaturan QRIS
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_img').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection

