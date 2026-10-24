@extends('administrator.layout')
@section('content_title', 'Pesan Masuk')

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

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Pesan Masuk dari Pengunjung</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Isi Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr id="row-{{ $item->id }}" class="{{ !$item->is_read ? 'table-warning fw-semibold' : '' }}">
                        <td>
                            @if (!$item->is_read)
                                <span class="badge bg-warning text-dark status-badge" id="badge-{{ $item->id }}">
                                    <i class="bi bi-envelope-fill me-1"></i> Baru
                                </span>
                            @else
                                <span class="badge bg-secondary status-badge" id="badge-{{ $item->id }}">
                                    <i class="bi bi-envelope-open me-1"></i> Dibaca
                                </span>
                            @endif
                        </td>
                        <td class="text-nowrap small text-muted">
                            <i class="bi bi-clock me-1"></i> {{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}
                        </td>
                        <td>
                            <div>{{ $item->name }}</div>
                            <small class="text-muted"><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></small>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 200px;">
                                {{ $item->subject }}
                            </div>
                        </td>
                        <td>
                            <div class="text-truncate text-muted small" style="max-width: 250px;">
                                {{ Str::limit($item->message, 80) }}
                            </div>
                        </td>
                        <td class="text-nowrap">
                            <button type="button" 
                                    class="btn btn-primary btn-sm view-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewMessageModal"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    data-email="{{ $item->email }}"
                                    data-subject="{{ $item->subject }}"
                                    data-date="{{ $item->created_at ? $item->created_at->format('d F Y, H:i WIB') : '-' }}"
                                    data-message="{{ $item->message }}"
                                    title="Baca Pesan Lengkap">
                                <i class="bi bi-eye"></i> Baca
                            </button>

                            <a href="mailto:{{ $item->email }}?subject=Re: {{ rawurlencode($item->subject) }}" 
                               class="btn btn-outline-success btn-sm" 
                               title="Balas via Email">
                                <i class="bi bi-reply"></i>
                            </a>

                            <button type="button" 
                                    class="delete-link btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteMessageModal"
                                    data-id="{{ $item->id }}"
                                    title="Hapus Pesan">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal Baca Pesan -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="viewMessageModalLabel">
            <i class="bi bi-envelope-open-text me-2 text-primary"></i> Rincian Pesan Masuk
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body p-4">
        <div class="p-3 bg-light rounded-3 mb-3">
            <div class="row g-2">
                <div class="col-sm-3 text-muted">Pengirim</div>
                <div class="col-sm-9 fw-bold text-dark" id="modal_name">-</div>

                <div class="col-sm-3 text-muted">Email</div>
                <div class="col-sm-9"><a href="" id="modal_email_link" class="text-primary">-</a></div>

                <div class="col-sm-3 text-muted">Waktu Kirim</div>
                <div class="col-sm-9 text-muted small" id="modal_date">-</div>

                <div class="col-sm-3 text-muted">Subjek</div>
                <div class="col-sm-9 fw-semibold text-dark" id="modal_subject">-</div>
            </div>
        </div>

        <div class="mt-4">
            <h6 class="fw-bold mb-2 text-dark">Isi Pesan:</h6>
            <div class="p-3 border rounded bg-white" style="white-space: pre-wrap; line-height: 1.7; min-height: 150px;" id="modal_message">-</div>
        </div>
      </div>

      <div class="modal-footer">
        <a href="" id="modal_reply_btn" class="btn btn-success">
            <i class="bi bi-reply-fill me-1"></i> Balas via Email
        </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="deleteMessageModalLabel">Konfirmasi Hapus Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus pesan ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Modal Baca Pesan
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const email = this.dataset.email;
                const subject = this.dataset.subject;
                const date = this.dataset.date;
                const message = this.dataset.message;

                document.getElementById('modal_name').innerText = name;
                document.getElementById('modal_email_link').innerText = email;
                document.getElementById('modal_email_link').href = `mailto:${email}`;
                document.getElementById('modal_date').innerText = date;
                document.getElementById('modal_subject').innerText = subject;
                document.getElementById('modal_message').innerText = message;
                document.getElementById('modal_reply_btn').href = `mailto:${email}?subject=Re: ${encodeURIComponent(subject)}`;

                // Tandai sebagai dibaca secara asinkron
                fetch(`/administrator/pesan-masuk/read/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    const row = document.getElementById(`row-${id}`);
                    if (row) {
                        row.classList.remove('table-warning', 'fw-semibold');
                    }
                    const badge = document.getElementById(`badge-${id}`);
                    if (badge) {
                        badge.className = 'badge bg-secondary status-badge';
                        badge.innerHTML = '<i class="bi bi-envelope-open me-1"></i> Dibaca';
                    }
                }).catch(err => console.error(err));
            });
        });

        // Modal Hapus Pesan
        const deleteButtons = document.querySelectorAll('.delete-link');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                deleteForm.action = `/administrator/pesan-masuk/delete/${id}`;
            });
        });
    });
</script>
@endsection

