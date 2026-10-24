@extends('administrator.layout')
@section('content_title', 'Informasi Kontak & Lokasi Pesantren')

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

@php
  $defaultAddress = 'Jl. Contoh No.123, Kabupaten/Kota, Indonesia';
  $defaultPhone = '0812-3456-7890';
  $defaultEmail = 'info@ponpes.com';
  $defaultHours = 'Senin - Sabtu (08:00 - 16:00 WIB)';
  $defaultMaps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.97085556088!2d110.33364489021656!3d-7.803248457435839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a582c7e459e7b%3A0x5701c5404fb7a847!2sLempuyangan!5e0!3m2!1sen!2sid!4v1781430015998!5m2!1sen!2sid';

  $currentAddress = old('address', $data->address ?? $defaultAddress);
  $currentPhone = old('phone', $data->phone ?? $defaultPhone);
  $currentEmail = old('email', $data->email ?? $defaultEmail);
  $currentHours = old('opening_hours', $data->opening_hours ?? $defaultHours);
  $currentMaps = old('maps_iframe', $data->maps_iframe ?? $defaultMaps);
@endphp

<div class="row">
    <!-- Kolom Preview Tampilan Kontak & Peta -->
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0"><i class="bi bi-eye me-2 text-primary"></i>Preview Tampilan di Website</h5>
            </div>
            <div class="card-body p-4">
                
                <h6 class="fw-bold mb-4 text-dark">Informasi Kontak</h6>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                    </div>
                    <div>
                        <strong class="text-dark d-block">Alamat Pesantren</strong>
                        <p class="mb-0 text-muted small" id="preview_address">{{ $currentAddress }}</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                        <i class="bi bi-telephone-fill fs-5"></i>
                    </div>
                    <div>
                        <strong class="text-dark d-block">Telepon / WhatsApp</strong>
                        <p class="mb-0 text-muted small" id="preview_phone">{{ $currentPhone }}</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                        <i class="bi bi-envelope-fill fs-5"></i>
                    </div>
                    <div>
                        <strong class="text-dark d-block">Email Resmi</strong>
                        <p class="mb-0 text-muted small" id="preview_email">{{ $currentEmail }}</p>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                        <i class="bi bi-clock-fill fs-5"></i>
                    </div>
                    <div>
                        <strong class="text-dark d-block">Jam Pelayanan Kantor</strong>
                        <p class="mb-0 text-muted small" id="preview_opening_hours">{{ $currentHours }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Preview Google Maps -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h6 class="card-title mb-0"><i class="bi bi-geo-alt me-2 text-danger"></i>Preview Google Maps</h6>
            </div>
            <div class="card-body p-2">
                <div class="rounded-3 overflow-hidden border">
                    <iframe 
                        id="preview_maps"
                        src="{{ $currentMaps }}" 
                        width="100%" 
                        height="240" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Form Ubah Informasi Kontak -->
    <div class="col-lg-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0"><i class="bi bi-pencil-square me-2 text-primary"></i>Ubah Informasi Kontak & Lokasi</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.contact_info.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="address" class="form-label fw-semibold">Alamat Pesantren <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap pesantren" required oninput="document.getElementById('preview_address').innerText = this.value">{{ $currentAddress }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label fw-semibold">Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $currentPhone }}" placeholder="Contoh: 0812-3456-7890" required oninput="document.getElementById('preview_phone').innerText = this.value">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-semibold">Email Resmi <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $currentEmail }}" placeholder="Contoh: info@ponpes.com" required oninput="document.getElementById('preview_email').innerText = this.value">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opening_hours" class="form-label fw-semibold">Jam Pelayanan Kantor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ $currentHours }}" placeholder="Contoh: Senin - Sabtu (08:00 - 16:00 WIB)" required oninput="document.getElementById('preview_opening_hours').innerText = this.value">
                    </div>

                    <div class="mb-4">
                        <label for="maps_iframe" class="form-label fw-semibold">Embed Google Maps (URL / Kode Iframe)</label>
                        <textarea class="form-control" id="maps_iframe" name="maps_iframe" rows="3" placeholder="Tempel URL embed (https://www.google.com/maps/embed?...) atau seluruh kode <iframe ...> dari Google Maps" oninput="updateMapsPreview(this.value)">{{ $currentMaps }}</textarea>
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-info-circle me-1"></i>Cara ambil: Buka Google Maps &rarr; Cari lokasi &rarr; Klik <strong>Bagikan (Share)</strong> &rarr; Pilih tab <strong>Sematkan peta (Embed a map)</strong> &rarr; Salin link atau seluruh kodenya.
                        </small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateMapsPreview(value) {
        if (!value) return;
        let url = value.trim();
        // Cek jika yang di-paste adalah tag <iframe>
        const match = url.match(/src=["']([^"']+)["']/);
        if (match && match[1]) {
            url = match[1];
        }
        if (url.startsWith('http://') || url.startsWith('https://')) {
            document.getElementById('preview_maps').src = url;
        }
    }
</script>
@endsection

