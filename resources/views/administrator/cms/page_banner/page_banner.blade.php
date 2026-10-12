@extends('administrator.layout')
@section('content_title', 'Banner Halaman Umum')

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

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title mb-1">Banner Halaman Umum</h5>
            <p class="text-muted small mb-0">Banner latar belakang ini otomatis digunakan secara seragam di seluruh halaman website (Program, Prestasi, Fasilitas, Berita, Informasi, Infaq, hingga Hubungi Kami).</p>
        </div>
    </div>
    <div class="card-body">
      @if ($data->count() === 0)
        <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
          <i class="bi bi-plus-circle"></i> Upload Banner
        </a>
      @endif

      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Preview Banner</th>
                    <th>Path File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Banner Halaman" class="rounded shadow-sm" style="max-height: 120px; max-width: 300px; object-fit: cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <code class="small">{{ $item->image ?? '-' }}</code>
                        </td>
                        <td class="text-truncate">
                            <a href="#" 
                                class="btn btn-success btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editDataModal"
                                data-id="{{ $item->id }}"
                                data-image="{{ $item->image }}">
                                <i class="bi bi-pencil"></i> Ganti Banner
                            </a>
                            <a href="#" 
                               class="delete-link btn btn-danger btn-sm" 
                               data-bs-toggle="modal" 
                               data-bs-target="#deleteDataModal"
                               data-id="{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Upload Banner Halaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.page_banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="image" class="form-label">Gambar Banner <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 20MB. Rekomendasi rasio landscape lebar (misal 1920x600 px).</small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="editDataModalLabel">Ganti Banner Halaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="editBannerForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id">

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_image" class="form-label">Gambar Banner Baru</label>
            <div class="mb-2">
              <img id="edit_image_preview" src="" alt="Preview Banner" class="rounded d-none w-100" style="max-height: 160px; object-fit: cover;">
            </div>
            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="deleteDataModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus banner ini? (Halaman akan kembali menggunakan background default).</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('a[data-bs-target="#editDataModal"]').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.querySelector('#editBannerForm');
                form.action = `/administrator/page-banner/update/${id}`;
                document.querySelector('#edit_id').value = id;

                const imgPreview = document.querySelector('#edit_image_preview');
                const imgVal = this.dataset.image;
                if (imgVal) {
                    imgPreview.src = `/storage/${imgVal}`;
                    imgPreview.classList.remove('d-none');
                } else {
                    imgPreview.src = '';
                    imgPreview.classList.add('d-none');
                }
            });
        });

        const deleteLinks = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/page-banner/delete/${id}`;
            });
        });
    });
</script>

