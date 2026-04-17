<!-- Modal Hapus Tugas -->
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus tugas ini?</p>
                <div class="row">
                    <div class="col-6">Nama User</div>
                    <div class="col-6">: {{ $item->nama }}</div>
                </div>
                <div class="row">
                    <div class="col-6">Laptop</div>
                    <div class="col-6">: {{ $item->laptop }}</div>
                </div>
                <div class="row">
                    <div class="col-6">Tanggal Mulai</div>
                    <div class="col-6">: {{ $item->tanggal_mulai }}</div>
                </div>
                <div class="row">
                    <div class="col-6">Tanggal Selesai</div>
                    <div class="col-6">: {{ $item->tanggal_selesai }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <form action="{{ route('tugasdestroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>