@extends('administrator.layout')
@section('content_title', 'Misi Pesantren')

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
            Misi Pesantren
        </h5>
    </div>
    <div class="card-body">
      @if ($data->count() === 0)
        <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
          <i class="bi bi-plus-circle"></i> Add Misi
        </a>
      @endif
      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Judul</th>
                    <th>Deskripsi Misi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->title ?? 'Misi' }}</td>
                        <td>
                            <div class="text-truncate" style="max-width: 500px;">
                                {{ Str::limit(strip_tags($item->description), 150) }}
                            </div>
                        </td>
                        <td class="text-truncate">
                            <a href="#" 
                                class="btn btn-success btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editDataModal"
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}">
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
        <h5 class="modal-title" id="addDataModalLabel">Add Misi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.misi.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Misi" value="Misi">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Misi (Bisa menggunakan poin / daftar)</label>
            <textarea class="form-control" id="description" name="description" rows="6" placeholder="Tuliskan butir-butir misi pesantren di sini..."></textarea>
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
        <h5 class="modal-title" id="editDataModalLabel">Edit Misi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="editMisiForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id">

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="edit_title" name="title">
          </div>

          <div class="mb-3">
            <label for="edit_description" class="form-label">Deskripsi Misi</label>
            <textarea class="form-control" id="edit_description" name="description" rows="6"></textarea>
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
          <p>Apakah Anda yakin ingin menghapus misi ini?</p>
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

        document.querySelectorAll('a[data-bs-target="#editDataModal"]').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.querySelector('#editMisiForm');
                form.action = `/administrator/misi/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_title').value = this.dataset.title || '';

                const descVal = this.dataset.description || '';
                editDescriptionEl.value = descVal;
                if (editorEdit) {
                    editorEdit.setData(descVal);
                }
            });
        });

        const editForm = document.querySelector('#editMisiForm');
        if (editForm) {
            editForm.addEventListener('submit', () => {
                if (editorEdit) {
                    editDescriptionEl.value = editorEdit.getData();
                }
            });
        }

        const deleteLinks = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/misi/delete/${id}`;
            });
        });
    });
</script>

