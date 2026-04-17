<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TugasExport;
use Carbon\Carbon;

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔥 AUTO UPDATE STATUS
        $tugasList = Tugas::with(['user', 'kategori'])->get();

        foreach ($tugasList as $item) {
            if (
                $item->status == 'dipinjam' &&
                Carbon::parse($item->tanggal_selesai)->lt(Carbon::now())
            ) {
                $item->status = 'terlambat'; // status baru
                $item->save();
            }
        }

        if ($user->jabatan == 'Admin') {
            $data = [
                'title' => 'Data Laptop',
                'menuadmintugas' => 'active',
                'tugas' => Tugas::with(['user', 'kategori'])->get(),
            ];
        } else {
            $data = [
                'title' => 'Data Laptop',
                'menukaryawantugas' => 'active',
                'tugas' => Tugas::with(['user', 'kategori'])->get(),
            ];
        }

        return view('admin.tugas.index', $data);
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('admin.tugas.create', [
            'title' => 'Tambah Data Laptop',
            'kategori' => $kategori
        ]);
    }
    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'laptop' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tugas = new Tugas();
        $tugas->nama = $request->nama; // simpan ID user
        $tugas->laptop = $request->laptop;
        $tugas->keterangan = $request->keterangan;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->status = 'pending';
        $tugas->save();

        return redirect()->route('tugas')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $kategori = Kategori::all(); // WAJIB

        return view('admin.tugas.edit', [
            'title' => 'Edit Data Laptop',
            'tugas' => $tugas,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'laptop' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->nama = $request->nama;
        $tugas->laptop = $request->laptop;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->save();

        return redirect()->route('tugas')->with('success', 'Data laptop berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->route('tugas')->with('success', 'Data laptop berhasil dihapus');
    }

    public function approve($id)
    {
        $item = Tugas::findOrFail($id);

        if ($item->status != 'pending') {
            return back()->with('error', 'Tidak bisa approve!');
        }

        $item->status = 'disetujui';
        $item->save();

        return back()->with('success', 'Disetujui');
    }

    public function reject($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->status = 'reject';
        $tugas->save();

        return redirect()->back()->with('success', 'Laptop di-reject');
    }

    public function detail($id)
    {
        $tugas = Tugas::with('kategori')->findOrFail($id);

        return view('admin.tugas.detail', [
            'title' => 'Detail Laptop',
            'tugas' => $tugas
        ]);
    }

    public function pinjam($id)
    {
        $item = Tugas::findOrFail($id);

        if ($item->status == 'disetujui') {

            $kategori = Kategori::find($item->laptop);

            // 🔥 CEK NULL (INI YANG KURANG)
            if (!$kategori) {
                return back()->with('error', 'Kategori tidak ditemukan!');
            }

            if ($kategori->jumlah > 0) {
                $kategori->jumlah -= 1;
                $kategori->jumlah_dipinjam += 1; // tambah ini
                $kategori->save();

                $item->status = 'dipinjam';
                $item->save();
            } else {
                return back()->with('error', 'Stok habis!');
            }
        }

        return back()->with('success', 'Laptop dipinjam');
    }

    public function kembali($id)
    {
        $item = Tugas::findOrFail($id);

        if (in_array($item->status, ['dipinjam', 'terlambat'])) {

            $kategori = Kategori::find($item->laptop);

            if ($kategori) {
                $kategori->jumlah += 1;
                $kategori->jumlah_dikembalikan += 1;
                $kategori->save();
            }

            $item->status = 'selesai';
            $item->save();
        }

        return back()->with('success', 'Laptop dikembalikan');
    }

    public function excel()
    {
        $filename = now()->format('d-m-y_h.i.s');
        $data = Tugas::with('kategori')->get();

        return Excel::download(new TugasExport($data), 'DataLaptop_' . $filename . '.xlsx');
    }

    public function pdf()
    {
        $filename = now()->format('d-m-y_h.i.s');
        $tugas = Tugas::with('kategori')->get();

        $pdf = Pdf::loadView('admin.tugas.pdf', compact('tugas'));
        return $pdf->download('DataLaptop_' . $filename . '.pdf');
    }
}
