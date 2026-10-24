@extends('administrator.layout')
@section('content_title', 'Rekening Transfer Infaq')

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
        <h5 class="card-title mb-0">Daftar Rekening Bank Infaq</h5>
    </div>
    <div class="card-body">
      <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal">
        <i class="bi bi-plus-circle"></i> Tambah Rekening Bank
      </a>

      <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Logo Bank</th>
                    <th>Nama Bank</th>
                    <th>Atas Nama</th>
                    <th>Nomor Rekening</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            @if ($item->logo_bank)
                                <img src="{{ asset('storage/' . $item->logo_bank) }}" alt="{{ $item->bank_name }}" class="bg-white p-1 rounded shadow-sm" style="max-height: 45px; max-width: 120px; object-fit: contain;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->bank_name }}</td>
                        <td>{{ $item->account_name }}</td>
                        <td>
                            <code class="fs-6">{{ $item->account_number }}</code>
                        </td>
                        <td class="text-truncate">
                            <a href="#" 
                                class="btn btn-success btn-sm edit-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editDataModal"
                                data-id="{{ $item->id }}"
                                data-bank="{{ $item->bank_name }}"
                                data-name="{{ $item->account_name }}"
                                data-number="{{ $item->account_number }}"
                                data-logo="{{ $item->logo_bank }}">
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
        <h5 class="modal-title" id="addDataModalLabel">Tambah Rekening Bank Infaq</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('admin.infaq_bank.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="logo_bank" class="form-label">Logo Bank <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="logo_bank" name="logo_bank" accept="image/*" required>
            <small class="text-muted">Format: PNG, JPG, JPEG, WEBP, SVG. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="bank_name" class="form-label">Nama Bank <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Contoh: Bank BCA / Bank Syariah Indonesia" required>
          </div>

          <div class="mb-3">
            <label for="account_name" class="form-label">Atas Nama Rekening <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Contoh: a.n Yayasan Ponpes Al-Qur'an" required>
          </div>

          <div class="mb-3">
            <label for="account_number" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Contoh: 1234567890" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Rekening</button>
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
        <h5 class="modal-title" id="editDataModalLabel">Edit Rekening Bank Infaq</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="editBankForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id">

        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_logo_bank" class="form-label">Logo Bank</label>
            <div class="mb-2">
              <img id="edit_logo_preview" src="" alt="Preview Logo" class="p-1 border rounded d-none shadow-sm" style="max-height: 60px; max-width: 150px; object-fit: contain;">
            </div>
            <input type="file" class="form-control" id="edit_logo_bank" name="logo_bank" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo. Maksimal 20MB.</small>
          </div>

          <div class="mb-3">
            <label for="edit_bank_name" class="form-label">Nama Bank <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="edit_bank_name" name="bank_name" required>
          </div>

          <div class="mb-3">
            <label for="edit_account_name" class="form-label">Atas Nama Rekening <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="edit_account_name" name="account_name" required>
          </div>

          <div class="mb-3">
            <label for="edit_account_number" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="edit_account_number" name="account_number" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update Rekening</button>
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
        <h5 class="modal-title" id="deleteDataModalLabel">Konfirmasi Hapus Rekening</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus rekening bank ini?</p>
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
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const form = document.querySelector('#editBankForm');
                form.action = `/administrator/infaq-bank/update/${id}`;
                document.querySelector('#edit_id').value = id;

                document.querySelector('#edit_bank_name').value = this.dataset.bank || '';
                document.querySelector('#edit_account_name').value = this.dataset.name || '';
                document.querySelector('#edit_account_number').value = this.dataset.number || '';

                const imgPreview = document.querySelector('#edit_logo_preview');
                const imgVal = this.dataset.logo;
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
                deleteForm.action = `/administrator/infaq-bank/delete/${id}`;
            });
        });
    });
</script>

