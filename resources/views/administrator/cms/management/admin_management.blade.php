@extends('administrator.layout')
@section('content_title', 'Manajemen Admin')

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

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title mb-0 text-dark">
                <i class="bi bi-people-fill me-2 text-primary"></i>Daftar Administrator Sistem
            </h5>
            <small class="text-muted">Kelola akun-akun yang memiliki akses masuk ke panel CMS Administrator</small>
        </div>
        <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalAddAdmin">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Admin Baru
        </button>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Administrator</th>
                        <th>Username</th>
                        <th>Alamat Email</th>
                        <th>Terdaftar Pada</th>
                        <th style="width: 140px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">
                                    {{ $user->name }}
                                    @if (Auth::id() == $user->id)
                                        <span class="badge bg-success-subtle text-success ms-1 small">
                                            <i class="bi bi-check-circle-fill me-1"></i>Akun Anda
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-person me-1"></i>{{ $user->username }}
                                </span>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="text-muted small">
                                {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }} WIB
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditAdmin{{ $user->id }}" title="Edit Akun">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                @if (Auth::id() != $user->id)
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteAdmin{{ $user->id }}" title="Hapus Akun">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm" disabled title="Anda tidak dapat menghapus akun Anda sendiri">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Edit Admin -->
                        <div class="modal fade" id="modalEditAdmin{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.management.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditLabel{{ $user->id }}">Edit Administrator</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                            </div>

                                            <hr class="my-3">
                                            <p class="small text-muted mb-2">
                                                <i class="bi bi-shield-lock me-1"></i><strong>Ubah Password:</strong> Biarkan kedua kolom password di bawah ini kosong jika Anda tidak ingin mengganti password admin ini.
                                            </p>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                                                <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" minlength="6">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password baru">
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

                        <!-- Modal Hapus Admin -->
                        @if (Auth::id() != $user->id)
                            <div class="modal fade" id="modalDeleteAdmin{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.management.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus Admin</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus akun administrator <strong>{{ $user->name }}</strong> (<code>{{ $user->username }}</code>)?</p>
                                                <p class="small text-danger mb-0">Akun ini tidak akan dapat login lagi ke panel sistem setelah dihapus.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus Akun</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Tidak ada data administrator ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin Baru -->
<div class="modal fade" id="modalAddAdmin" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.management.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Administrator Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Contoh: Muhammad Ihsan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Contoh: ihsan_admin" required>
                        <small class="text-muted">Digunakan untuk login ke panel sistem.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Contoh: ihsan@ponpes.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" minlength="6" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password" minlength="6" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Admin Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

