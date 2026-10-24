@extends('administrator.layout')
@section('content_title', 'Informasi / Pengumuman')

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
        <h5 class="card-title mb-0">Manajemen Informasi & Pengumuman</h5>
    </div>
    <div class="card-body">
      <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
        <i class="bi bi-plus-circle"></i> Tambah Informasi Baru
      </a>

      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Foto</th>
                    <th>Judul Informasi</th>
                    <th>Tanggal</th>
                    <th>Ringkasan Konten</th>
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
                        <td>
                            <div class="fw-semibold">{{ $item->title }}</div>
                            <small class="text-muted">Slug: <code>{{ $item->slug }}</code></small>
                        </td>
                        <td class="text-nowrap small text-muted">
                            <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 320px;">
                                {{ Str::limit(strip_tags($item->content), 90) }}
                            </div>
                        </td>
                        <td class="text-truncate">
                            <a href="{{ route('website.informasi.detail', $item->slug) }}" 
                               target="_blank" 
                               class="btn btn-info btn-sm text-white" 
                               title="Lihat di Website">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="#" 
                                class="btn btn-success btn-sm edit-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editDataModal"
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-content="{{ htmlspecialchars($item->content) }}"
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
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Tambah Informasi Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="image" class="form-label">Foto Utama Informasi <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Judul Informasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul informasi..." required>
          </div>

          <div class="mb-3">
            <label for="content_add" class="form-label">Isi Konten Informasi <span class="text-danger">*</span></label>
            <textarea class="form-control" id="content_add" name="content" rows="10" placeholder="Tulis isi pengumuman / informasi..."></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Informasi</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="editDataModalLabel">Edit Informasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="editInformasiForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id">

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_image" class="form-label">Foto Utama Informasi</label>
            <div class="mb-2">
              <img id="edit_image_preview" src="" alt="Preview Foto" class="rounded d-none shadow-sm" style="height: 120px; width: 180px; object-fit: cover;">
            </div>
            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="edit_title" class="form-label">Judul Informasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="edit_title" name="title" required>
          </div>

          <div class="mb-3">
            <label for="content_edit" class="form-label">Isi Konten Informasi <span class="text-danger">*</span></label>
            <textarea class="form-control" id="content_edit" name="content" rows="10"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update Informasi</button>
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
        <h5 class="modal-title" id="deleteDataModalLabel">Konfirmasi Hapus Informasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus informasi ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>

    </div>
  </div>
</div>

<style>
  .ck-editor__editable_inline {
    min-height: 250px;
  }
</style>

@endsection

<script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let editorAdd = null;
        const addContentEl = document.querySelector('#content_add');
        if (addContentEl && typeof ClassicEditor !== 'undefined') {
            ClassicEditor.create(addContentEl)
                .then(editor => {
                    editorAdd = editor;
                    editor.model.document.on('change:data', () => {
                        addContentEl.value = editor.getData();
                    });
                })
                .catch(error => console.error(error));
        }

        const addForm = document.querySelector('#addDataModal form');
        if (addForm) {
            addForm.addEventListener('submit', () => {
                if (editorAdd) {
                    addContentEl.value = editorAdd.getData();
                }
            });
        }

        let editorEdit = null;
        const editContentEl = document.querySelector('#content_edit');
        if (editContentEl && typeof ClassicEditor !== 'undefined') {
            ClassicEditor.create(editContentEl)
                .then(editor => {
                    editorEdit = editor;
                    editor.model.document.on('change:data', () => {
                        editContentEl.value = editor.getData();
                    });
                })
                .catch(error => console.error(error));
        }

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.querySelector('#editInformasiForm');
                form.action = `/administrator/informasi/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_title').value = this.dataset.title || '';

                const rawContent = this.dataset.content || '';
                const decodedContent = new DOMParser().parseFromString(rawContent, 'text/html').body.textContent || rawContent;
                editContentEl.value = decodedContent;
                if (editorEdit) {
                    editorEdit.setData(decodedContent);
                }

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

        const editForm = document.querySelector('#editInformasiForm');
        if (editForm) {
            editForm.addEventListener('submit', () => {
                if (editorEdit) {
                    editContentEl.value = editorEdit.getData();
                }
            });
        }

        const deleteLinks = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/informasi/delete/${id}`;
            });
        });
    });
</script>

