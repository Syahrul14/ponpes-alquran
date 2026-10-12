@extends('administrator.layout')
@section('content_title', 'Program')

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
        <h5 class="card-title mb-0">Program</h5>
    </div>
    <div class="card-body">
      <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
        <i class="bi bi-plus-circle"></i> Tambah Program
      </a>

      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Foto</th>
                    <th>Judul Program</th>
                    <th>Deskripsi Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="rounded shadow-sm" style="width: 100px; height: 70px; object-fit: cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->title }}</td>
                        <td>
                            <div class="text-truncate" style="max-width: 380px;">
                                {{ $item->description }}
                            </div>
                        </td>
                        <td class="text-truncate">
                            <a href="#" 
                                class="btn btn-success btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editDataModal"
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}"
                                data-image="{{ $item->image }}">
                                <i class="bi bi-pencil"></i>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Tambah Program Pembelajaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.program_card.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="image" class="form-label">Foto Program <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Judul Program <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Tahfidz Al-Qur'an" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Program <span class="text-danger">*</span></label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Penjelasan singkat mengenai program pembelajaran..." required></textarea>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="editDataModalLabel">Edit Program Pembelajaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="editProgramForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id">

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_image" class="form-label">Foto Program</label>
            <div class="mb-2">
              <img id="edit_image_preview" src="" alt="Preview Foto" class="rounded d-none shadow-sm" style="height: 120px; width: 180px; object-fit: cover;">
            </div>
            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="edit_title" class="form-label">Judul Program <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="edit_title" name="title" required>
          </div>

          <div class="mb-3">
            <label for="edit_description" class="form-label">Deskripsi Program <span class="text-danger">*</span></label>
            <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
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
          <p>Apakah Anda yakin ingin menghapus program ini?</p>
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
                const form = document.querySelector('#editProgramForm');
                form.action = `/administrator/program-card/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_title').value = this.dataset.title || '';
                document.querySelector('#edit_description').value = this.dataset.description || '';

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
                deleteForm.action = `/administrator/program-card/delete/${id}`;
            });
        });
    });
</script>

