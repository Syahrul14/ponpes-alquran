@extends('administrator.layout')
@section('content_title', 'Home Profile')

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
            Home Profile
        </h5>
    </div>
    <div class="card-body">
      @if ($data->count() === 0)
        <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
          <i class="bi bi-plus-circle"></i> Add
        </a>
      @endif
      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Profile Image" width="100" class="rounded">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <div class="text-truncate" style="max-width: 300px;">
                                {{ Str::limit(strip_tags($item->description), 100) }}
                            </div>
                        </td>
                        <td>
                            @if ($item->link)
                                <a href="{{ $item->link }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 150px;">
                                    {{ $item->link }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-truncate">
                            <a href="#" 
                                class="btn btn-success btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editDataModal"
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}"
                                data-link="{{ $item->link }}"
                                data-image="{{ $item->image }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" 
                               class="delete-link btn btn-danger btn-sm" 
                               data-bs-toggle="modal" 
                               data-bs-target="#deleteUserModal"
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
        <h5 class="modal-title" id="addDataModalLabel">Add Home Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.home_profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul profil">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan deskripsi profil"></textarea>
          </div>

          <div class="mb-3">
            <label for="link" class="form-label">Link (Selengkapnya)</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Contoh: profil/sejarah">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- ================= Edit Modal ================= -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Home Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editProfileForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit_image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="edit_image" accept="image/*">
                <img id="edit_image_preview" src="" width="120" class="mt-2 rounded d-none">
            </div>

            <div class="mb-3">
                <label for="edit_title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="edit_title">
            </div>

            <div class="mb-3">
                <label for="edit_description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="edit_description" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label for="edit_link" class="form-label">Link (Selengkapnya)</label>
                <input type="text" class="form-control" name="link" id="edit_link">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Delete Home Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Event edit button
        document.querySelectorAll('a[data-bs-target="#editDataModal"]').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.querySelector('#editProfileForm');
                form.action = `/administrator/home-profile/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_title').value = this.dataset.title || '';
                document.querySelector('#edit_description').value = this.dataset.description || '';
                document.querySelector('#edit_link').value = this.dataset.link || '';

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

        // Event delete button
        const deleteLinks = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/home-profile/delete/${id}`;
            });
        });
    });
</script>
