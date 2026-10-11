@extends('administrator.layout')
@section('content_title', 'History Profile')

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
    <div class="card-header">
        <h5 class="card-title">
            History Profile
        </h5>
    </div>
    <div class="card-body">
      @if ($data->count() === 0)
        <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
          <i class="bi bi-plus-circle"></i> Add Profile
        </a>
      @endif
      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Quotes</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Foto Sejarah" width="120" class="rounded">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->title ?? '-' }}</td>
                        <td>
                            <div class="text-truncate" style="max-width: 300px;">
                                {{ Str::limit(strip_tags($item->description), 100) }}
                            </div>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 200px;">
                                {{ $item->quotes ?? '-' }}
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
                                data-quotes="{{ $item->quotes }}"
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
        <h5 class="modal-title" id="addDataModalLabel">Add History Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.history_profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="image" class="form-label">Foto Sejarah / Gedung</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Membangun Generasi Qur'ani Sejak Awal Berdiri">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Sejarah</label>
            <textarea class="form-control" id="description" name="description" rows="6" placeholder="Narasi sejarah lengkap..."></textarea>
          </div>

          <div class="mb-3">
            <label for="quotes" class="form-label">Quotes / Kutipan Visi</label>
            <input type="text" class="form-control" id="quotes" name="quotes" placeholder="Contoh: Menjadikan Al-Qur'an sebagai pemandu jalan hidup...">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
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
        <h5 class="modal-title" id="editDataModalLabel">Edit History Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="editProfileForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id">

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_image" class="form-label">Foto Sejarah / Gedung</label>
            <div class="mb-2">
              <img id="edit_image_preview" src="" alt="Preview Foto" class="rounded d-none" style="max-height: 150px; width: auto; object-fit: cover;">
            </div>
            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG, WEBP. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="edit_title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="edit_title" name="title">
          </div>

          <div class="mb-3">
            <label for="edit_description" class="form-label">Deskripsi Sejarah</label>
            <textarea class="form-control" id="edit_description" name="description" rows="6"></textarea>
          </div>

          <div class="mb-3">
            <label for="edit_quotes" class="form-label">Quotes / Kutipan Visi</label>
            <input type="text" class="form-control" id="edit_quotes" name="quotes">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        <h5 class="modal-title" id="deleteDataModalLabel">Delete Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus profile sejarah ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection

<script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // CKEditor Add
        let editorAdd = null;
        const addDescriptionEl = document.querySelector('#description');
        if (addDescriptionEl) {
            ClassicEditor.create(addDescriptionEl)
                .then(editor => {
                    editorAdd = editor;
                    editor.model.document.on('change:data', () => {
                        addDescriptionEl.value = editor.getData();
                    });
                })
                .catch(error => console.error(error));
        }

        const addForm = document.querySelector('#addDataModal form');
        if (addForm) {
            addForm.addEventListener('submit', () => {
                if (editorAdd) {
                    addDescriptionEl.value = editorAdd.getData();
                }
            });
        }

        // CKEditor Edit
        let editorEdit = null;
        const editDescriptionEl = document.querySelector('#edit_description');
        if (editDescriptionEl) {
            ClassicEditor.create(editDescriptionEl)
                .then(editor => {
                    editorEdit = editor;
                    editor.model.document.on('change:data', () => {
                        editDescriptionEl.value = editor.getData();
                    });
                })
                .catch(error => console.error(error));
        }

        // Event Edit modal
        document.querySelectorAll('a[data-bs-target="#editDataModal"]').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.querySelector('#editProfileForm');
                form.action = `/administrator/history-profile/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_title').value = this.dataset.title || '';
                document.querySelector('#edit_quotes').value = this.dataset.quotes || '';

                const descVal = this.dataset.description || '';
                editDescriptionEl.value = descVal;
                if (editorEdit) {
                    editorEdit.setData(descVal);
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

        // Submit form edit
        const editForm = document.querySelector('#editProfileForm');
        if (editForm) {
            editForm.addEventListener('submit', () => {
                if (editorEdit) {
                    editDescriptionEl.value = editorEdit.getData();
                }
            });
        }

        // Delete modal
        const deleteLinks = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/history-profile/delete/${id}`;
            });
        });
    });
</script>

