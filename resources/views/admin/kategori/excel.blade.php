<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Laptop</th>
            <th>Penanggung Jawab</th>
            <th>Dipinjam</th>
            <th>Dikembalikan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_laptop }}</td>
            <td>{{ $item->penanggung_jawab }}</td>
            <td>{{ $item->jumlah_dipinjam ?? 0 }}</td>
            <td>{{ $item->jumlah_dikembalikan ?? 0 }}</td>
            <td>{{ $item->jumlah }}</td>
        </tr>
        @endforeach
    </tbody>
</table>