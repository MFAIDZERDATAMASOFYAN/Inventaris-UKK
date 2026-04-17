<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Laptop</th>
            <th>Penanggung Jawab</th>
            <th>Keterangan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tugas as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->kategori->nama_laptop ?? '-' }}</td>
            <td>{{ $item->kategori->penanggung_jawab ?? '-' }}</td>
            <td>{{ $item->keterangan ?? '-' }}</td>
            <td>{{ $item->tanggal_mulai }}</td>
            <td>{{ $item->tanggal_selesai }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>