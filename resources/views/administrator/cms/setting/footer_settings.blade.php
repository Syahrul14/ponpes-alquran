@extends('administrator.layout')
@section('content_title', 'Pengaturan Web & Footer')

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
  $defaultName = "Ponpes Al-Qur'an Rizky Amalia";
  $defaultAbout = "Membentuk generasi Qur'ani yang berakhlak mulia, cerdas, mandiri, dan berwawasan luas berlandaskan Al-Qur'an dan As-Sunnah.";
  $defaultCopyright = "Ponpes Al-Qur'an Rizky Amalia. All Rights Reserved.";

  $currentName = old('pesantren_name', $footerSetting->pesantren_name ?? $defaultName);
  $currentAbout = old('about_text', $footerSetting->about_text ?? $defaultAbout);
  $currentCopyright = old('copyright_text', $footerSetting->copyright_text ?? $defaultCopyright);
@endphp

<!-- Card 1: Identitas & Logo Pesantren -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="card-title mb-0 text-dark">
            <i class="bi bi-sliders me-2 text-primary"></i>Pengaturan Logo, Identitas & Teks Footer
        </h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.footer_setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row align-items-center mb-4 pb-3 border-bottom">
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <label class="form-label fw-bold d-block mb-2">Logo Ponpes Saat Ini</label>
                    <div class="p-3 bg-light rounded-3 border d-inline-block shadow-sm">
                        @if ($footerSetting && !empty($footerSetting->logo))
                            <img id="preview_logo_ponpes" src="{{ asset('storage/' . $footerSetting->logo) }}" alt="Logo Ponpes" class="img-fluid" style="max-height: 70px; max-width: 160px; object-fit: contain;">
                        @else
                            <img id="preview_logo_ponpes" src="{{ asset('assets/images/core/logo.png') }}" alt="Logo Ponpes" class="img-fluid" style="max-height: 70px; max-width: 160px; object-fit: contain;">
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <label for="logo" class="form-label fw-semibold">Ganti File Logo Ponpes</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewLogoFile(event)">
                    <small class="text-muted d-block mt-1">
                        Format disarankan: PNG transparan atau SVG. Maksimal 5MB. Biarkan kosong jika tidak ingin mengubah logo.
                    </small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pesantren_name" class="form-label fw-semibold">Nama Pesantren / Brand <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="pesantren_name" name="pesantren_name" value="{{ $currentName }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="copyright_text" class="form-label fw-semibold">Teks Hak Cipta (Copyright) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="copyright_text" name="copyright_text" value="{{ $currentCopyright }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="about_text" class="form-label fw-semibold">Slogan / Deskripsi Singkat Footer</label>
                <textarea class="form-control" id="about_text" name="about_text" rows="3">{{ $currentAbout }}</textarea>
                <small class="text-muted">Teks ini tampil di bawah logo pada kolom pertama footer.</small>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.contact_info.getData') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-geo-alt me-1"></i> Edit Kontak & Alamat di Informasi Kontak &rarr;
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Simpan Identitas & Footer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Card 2: Daftar Media Sosial Pesantren -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 text-dark">
            <i class="bi bi-share me-2 text-success"></i>Daftar Media Sosial Pesantren
        </h5>
        <button type="button" class="btn btn-success btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalAddSocialMedia">
            <i class="bi bi-plus-circle me-1"></i> Tambah Media Sosial
        </button>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th style="width: 80px;" class="text-center">Icon</th>
                        <th>Nama Platform</th>
                        <th>URL Tautan</th>
                        <th style="width: 90px;" class="text-center">Urutan</th>
                        <th style="width: 100px;" class="text-center">Status</th>
                        <th style="width: 140px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($socialMediaList as $index => $socmed)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-center">
                                <div class="rounded-circle border d-inline-flex align-items-center justify-content-center p-1 bg-light shadow-sm" style="width: 40px; height: 40px;">
                                    <img src="{{ asset('storage/' . $socmed->image) }}" alt="{{ $socmed->name }}" style="max-width: 24px; max-height: 24px; object-fit: contain;">
                                </div>
                            </td>
                            <td class="fw-semibold text-dark">{{ $socmed->name }}</td>
                            <td>
                                <a href="{{ $socmed->url }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-truncate d-inline-block" style="max-width: 280px;">
                                    {{ $socmed->url }} <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                            <td class="text-center">{{ $socmed->order }}</td>
                            <td class="text-center">
                                @if ($socmed->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditSocialMedia{{ $socmed->id }}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteSocialMedia{{ $socmed->id }}" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Edit Media Sosial -->
                        <div class="modal fade" id="modalEditSocialMedia{{ $socmed->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $socmed->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.footer_setting.social_media.update', $socmed->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditLabel{{ $socmed->id }}">Edit Media Sosial</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nama Platform <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $socmed->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">URL Tautan <span class="text-danger">*</span></label>
                                                <input type="url" class="form-control" name="url" value="{{ $socmed->url }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Icon / Logo Medsos (Gambar)</label>
                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                    <div class="p-2 border rounded bg-light">
                                                        <img id="preview_edit_img_{{ $socmed->id }}" src="{{ asset('storage/' . $socmed->image) }}" alt="{{ $socmed->name }}" style="max-height: 35px; max-width: 35px; object-fit: contain;">
                                                    </div>
                                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti logo.</small>
                                                </div>
                                                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewEditImage(event, {{ $socmed->id }})">
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label class="form-label fw-semibold">Urutan Tampil</label>
                                                    <input type="number" class="form-control" name="order" value="{{ $socmed->order }}" min="0">
                                                </div>
                                                <div class="col-6 mb-3 d-flex align-items-center pt-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="is_active_{{ $socmed->id }}" name="is_active" value="1" {{ $socmed->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_active_{{ $socmed->id }}">Tampilkan di Footer</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus Media Sosial -->
                        <div class="modal fade" id="modalDeleteSocialMedia{{ $socmed->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.footer_setting.social_media.delete', $socmed->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus media sosial <strong>{{ $socmed->name }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                Belum ada media sosial ditambahkan. Silakan klik tombol <strong>Tambah Media Sosial</strong>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Media Sosial -->
<div class="modal fade" id="modalAddSocialMedia" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.footer_setting.social_media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Media Sosial Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Platform <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Contoh: Instagram, YouTube, TikTok, Facebook" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">URL Tautan <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="url" placeholder="https://instagram.com/akun_ponpes" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Icon / Logo Medsos (Gambar) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="image" accept="image/*" required onchange="previewAddImage(event)">
                        <small class="text-muted d-block mt-1">Disarankan format PNG transparan atau SVG. Maksimal 2MB.</small>
                        <div id="add_image_preview_box" class="mt-2 p-2 border rounded bg-light d-none" style="width: fit-content;">
                            <img id="preview_add_img" src="#" alt="Preview" style="max-height: 40px; max-width: 40px; object-fit: contain;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">Urutan Tampil</label>
                            <input type="number" class="form-control" name="order" value="0" min="0">
                        </div>
                        <div class="col-6 mb-3 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active_add" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active_add">Langsung Tampilkan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Media Sosial</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewLogoFile(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_logo_ponpes').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewAddImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_add_img').src = e.target.result;
                document.getElementById('add_image_preview_box').classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewEditImage(event, id) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_edit_img_' + id).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

