@extends('layout.admin.template')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h6 class="mb-4">Data Review</h6>
                    
                    <div class="d-flex justify-content-end mb-3">
                        <form method="GET" action="{{ route('admin.review.index') }}" class="d-flex gap-2">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
                                <option value="publish" {{ request('status') == 'publish' ? 'selected' : '' }}>Dipublikasikan</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </form>
                    </div>
                    
                    

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th style="word-break: break-word; white-space: normal; max-width: 250px;">Pesan</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $key => $review)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $review->nama }}</td>
                                <td>{{ $review->email }}</td>
                                <td>{{ $review->telepon ?? '-' }}</td>
                                <td style="word-break: break-word; white-space: normal; max-width: 250px;">{{ $review->pesan ?? '-' }}</td>
                                <td>{{ $review->rating }} / 5</td>
                                <td>
                                    @if($review->status == 'publish')
                                        <span class="text-success">Dipublikasikan</span>
                                    @else
                                        <span class="text-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($review->status == 'pending')
                                        <form action="{{ route('admin.review.publish', $review->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success d-block w-100">Publikasikan</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.review.unpublish', $review->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning d-block w-100">Pending</button>
                                        </form>
                                    @endif

                                    <button class="mt-2 btn btn-danger d-block w-100" onclick="confirmDelete('{{ route('admin.review.destroy', $review->id) }}')">
                                        Hapus
                                    </button>
                                </td>
                                
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Data Review Belum Ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(deleteUrl) {
        document.getElementById('deleteForm').action = deleteUrl;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>

@endsection
