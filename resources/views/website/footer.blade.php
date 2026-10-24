<footer class="text-white pt-5 pb-3" style="background-color: #1e293b;">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-4 col-md-6">
        <div class="d-flex align-items-center mb-3 gap-3">
          <img src="{{ !empty($globalFooter?->logo) ? asset('storage/' . $globalFooter->logo) : asset('assets/images/core/logo.png') }}" alt="Logo Ponpes" class="me-2" style="height: 45px; max-width: 120px; object-fit: contain;">
          <h5 class="fw-bold mb-0 text-success-subtle">
            {{ $globalFooter->pesantren_name ?? "Ponpes Al-Qur'an Rizky Amalia" }}
          </h5>
        </div>
        <p class="text-secondary small">
          {{ $globalFooter->about_text ?? "Membentuk generasi Qur'ani yang berakhlak mulia, cerdas, mandiri, dan berwawasan luas berlandaskan Al-Qur'an dan As-Sunnah." }}
        </p>
      </div>

      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold mb-3 border-bottom border-success border-2 pb-2" style="width: fit-content;">Kontak Kami</h5>
        <ul class="list-unstyled text-secondary small">
          <li class="mb-2 d-flex align-items-start">
            <i class="fas fa-map-marker-alt text-success mt-1 me-2"></i>
            <span>{{ $globalContact->address ?? 'Jl. Raya Ponpes No. 12, Kecamatan xxx, Kabupaten xxx' }}</span>
          </li>
          <li class="mb-2">
            <i class="fas fa-phone text-success me-2"></i>{{ $globalContact->phone ?? '+62 812-3456-7890' }}
          </li>
          <li class="mb-2">
            <i class="fas fa-envelope text-success me-2"></i>{{ $globalContact->email ?? 'info@rizkyamalia.ponpes.id' }}
          </li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h5 class="fw-bold mb-3 border-bottom border-success border-2 pb-2" style="width: fit-content;">Media Sosial</h5>
        <p class="text-secondary small mb-3">Ikuti perkembangan aktivitas santri melalui kanal resmi kami:</p>
        <div class="d-flex gap-2 flex-wrap">
          @forelse ($globalSocialMedia as $socmed)
            <a href="{{ $socmed->url }}" target="_blank" rel="noopener noreferrer" 
               class="btn btn-outline-success border-secondary rounded-circle d-flex align-items-center justify-content-center p-1" 
               style="width: 38px; height: 38px; background-color: rgba(255,255,255,0.05);" 
               title="{{ $socmed->name }}">
              <img src="{{ asset('storage/' . $socmed->image) }}" alt="{{ $socmed->name }}" 
                   style="max-width: 20px; max-height: 20px; object-fit: contain;">
            </a>
          @empty
            <!-- Default placeholder icons jika belum ada medsos diunggah -->
            <a href="#" class="btn btn-outline-success border-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; padding: 0;">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-outline-success border-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; padding: 0;">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="btn btn-outline-success border-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; padding: 0;">
              <i class="fab fa-youtube"></i>
            </a>
          @endforelse
        </div>
      </div>

    </div>

    <hr class="border-secondary my-4">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
        <p class="mb-0 text-secondary small">&copy; {{ date('Y') }} {{ $globalFooter->copyright_text ?? "Ponpes Al-Qur'an Rizky Amalia. All Rights Reserved." }}</p>
      </div>
      {{-- <div class="col-md-6 text-center text-md-end">
        <p class="mb-0 text-secondary small">Developed by <span class="text-success-subtle fw-semibold">Syahrul Rizal</span></p>
      </div> --}}
    </div>

  </div>
</footer>
