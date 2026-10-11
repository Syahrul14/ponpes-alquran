@extends('administrator.layout')
@section('content_title', 'Home Banner')

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
            Home Banner
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
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Link</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>Image 3</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->sub_title }}</td>
                        <td>
                            @if ($item->link)
                                <a href="{{ $item->link }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 150px;">
                                    {{ $item->link }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->image_1)
                                <img src="{{ asset('storage/' . $item->image_1) }}" alt="Image 1" width="100" class="rounded">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->image_2)
                                <img src="{{ asset('storage/' . $item->image_2) }}" alt="Image 2" width="100" class="rounded">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->image_3)
                                <img src="{{ asset('storage/' . $item->image_3) }}" alt="Image 3" width="100" class="rounded">
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
                                data-sub_title="{{ $item->sub_title }}"
                                data-link="{{ $item->link }}"
                                data-image_1="{{ $item->image_1 }}"
                                data-image_2="{{ $item->image_2 }}"
                                data-image_3="{{ $item->image_3 }}">
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
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Add Home Banner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.home_banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan title">
          </div>

          <div class="mb-3">
            <label for="sub_title" class="form-label">Sub Title</label>
            <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Masukkan sub title">
          </div>

          <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Masukkan link tujuan">
          </div>

          <div class="mb-3">
            <label for="image_1" class="form-label">Image 1</label>
            <input type="file" class="form-control" id="image_1" name="image_1" accept="image/*">
          </div>

          <div class="mb-3">
            <label for="image_2" class="form-label">Image 2</label>
            <input type="file" class="form-control" id="image_2" name="image_2" accept="image/*">
          </div>

          <div class="mb-3">
            <label for="image_3" class="form-label">Image 3</label>
            <input type="file" class="form-control" id="image_3" name="image_3" accept="image/*">
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Home Banner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editBannerForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit_title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="edit_title">
            </div>

            <div class="mb-3">
                <label for="edit_sub_title" class="form-label">Sub Title</label>
                <input type="text" class="form-control" name="sub_title" id="edit_sub_title">
            </div>

            <div class="mb-3">
                <label for="edit_link" class="form-label">Link</label>
                <input type="text" class="form-control" name="link" id="edit_link">
            </div>

            <div class="mb-3">
                <label for="edit_image_1" class="form-label">Image 1</label>
                <input type="file" class="form-control" name="image_1" id="edit_image_1" accept="image/*">
                <img id="edit_image_1_preview" src="" width="100" class="mt-2 rounded d-none">
            </div>

            <div class="mb-3">
                <label for="edit_image_2" class="form-label">Image 2</label>
                <input type="file" class="form-control" name="image_2" id="edit_image_2" accept="image/*">
                <img id="edit_image_2_preview" src="" width="100" class="mt-2 rounded d-none">
            </div>

            <div class="mb-3">
                <label for="edit_image_3" class="form-label">Image 3</label>
                <input type="file" class="form-control" name="image_3" id="edit_image_3" accept="image/*">
                <img id="edit_image_3_preview" src="" width="100" class="mt-2 rounded d-none">
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
        <h5 class="modal-title" id="deleteUserModalLabel">Delete Home Banner</h5>
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
                const form = document.querySelector('#editBannerForm');
                form.action = `/administrator/home-banner/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_title').value = this.dataset.title || '';
                document.querySelector('#edit_sub_title').value = this.dataset.sub_title || '';
                document.querySelector('#edit_link').value = this.dataset.link || '';

                // Preview images
                ['image_1', 'image_2', 'image_3'].forEach(imgKey => {
                    const imgPreview = document.querySelector(`#edit_${imgKey}_preview`);
                    const imgVal = this.dataset[imgKey];
                    if (imgVal) {
                        imgPreview.src = `/storage/${imgVal}`;
                        imgPreview.classList.remove('d-none');
                    } else {
                        imgPreview.src = '';
                        imgPreview.classList.add('d-none');
                    }
                });
            });
        });

        // Event delete button
        const deleteLinks = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/home-banner/delete/${id}`;
            });
        });
    });
</script>
