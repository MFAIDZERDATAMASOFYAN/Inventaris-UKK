<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">

            <!-- Header -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <p class="text-center font-weight-bold text-danger">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>

                <hr>

                <div class="row mb-2">
                    <div class="col-5 text-muted">Nama</div>
                    <div class="col-7 font-weight-bold">: {{ $item->nama }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5 text-muted">Laptop</div>
                    <div class="col-7">: {{ $item->kategori->nama_laptop ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5 text-muted">Tanggal</div>
                    <div class="col-7">
                        : {{ $item->tanggal_mulai }} s/d {{ $item->tanggal_selesai }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn btn-light border" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>

                <form action="{{ route('tugasdestroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0">

            <!-- Header -->
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i> Detail Peminjaman
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">Nama</small>
                        <div class="font-weight-bold">{{ $item->nama }}</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Laptop</small>
                        <div class="font-weight-bold">
                            {{ $item->kategori->nama_laptop ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">Penanggung Jawab</small>
                        <div>{{ $item->kategori->penanggung_jawab ?? '-' }}</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Status</small>
                        <div>
                            <span class="badge badge-info px-3 py-2">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Keterangan</small>
                    <div class="border rounded p-2 bg-light">
                        {{ $item->keterangan ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">Tanggal Mulai</small>
                        <div class="badge badge-primary px-3 py-2">
                            {{ $item->tanggal_mulai }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Tanggal Selesai</small>
                        <div class="badge badge-success px-3 py-2">
                            {{ $item->tanggal_selesai }}
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>

        </div>
    </div>
</div>