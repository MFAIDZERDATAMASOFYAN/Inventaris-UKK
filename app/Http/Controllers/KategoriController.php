<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KategoriExport;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kategori Laptop',
            'menuadminkategori' => 'active',
            'kategori' => Kategori::all()
        ];

        return view('admin.kategori.index', $data);
    }

    public function create()
    {
        return view('admin.kategori.create', [
            'title' => 'Tambah Kategori'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_laptop' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ], [
            'nama_laptop.required' => 'Nama laptop wajib diisi',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah minimal 1',
        ]);

        \App\Models\Kategori::create([
            'nama_laptop' => $request->nama_laptop,
            'penanggung_jawab' => $request->penanggung_jawab,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('kategori')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.kategori.edit', [
            'title' => 'Edit Kategori',
            'kategori' => Kategori::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_laptop' => 'required',
            'penanggung_jawab' => 'required',
            'jumlah' => 'required|integer'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function excel()
    {
        $filename = now()->format('d-m-y_h.i.s');
        $kategori = Kategori::all();

        return Excel::download(new KategoriExport($kategori), 'DataKategori_' . $filename . '.xlsx');
    }

    public function pdf()
    {
        $filename = now()->format('d-m-y_h.i.s');
        $kategori = Kategori::all();

        $pdf = Pdf::loadView('admin.kategori.pdf', compact('kategori'));
        return $pdf->download('DataKategori_' . $filename . '.pdf');
    }
}
