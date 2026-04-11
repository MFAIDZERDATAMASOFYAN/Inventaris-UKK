<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TugasController extends Controller
{
        public function index() {

        $user = Auth::user();

        if ($user->jabatan=='Admin'){
            $data = array(
            'title' => 'Data Laptop',
            'menuadmintugas' => 'active',
            'tugas' => Tugas::with('user')->get(),
        );

        return view('admin.tugas.index', $data);
        } else {
            $data = array(
            'title' => 'Data tugas',
            'menukaryawantugas' => 'active',
            'tugas' => Tugas::with('user')->get(),
        );

        return view('admin.tugas.index', $data);
        }
    }

    public function create()
{
    $users = \App\Models\User::all(); // ambil semua user
    $data = [
        'title' => 'Tambah Data Tugas',
        'users' => $users, // pastikan ini
    ];
    return view('admin.tugas.create', $data);
}
    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
    'user_id' => 'required|exists:users,id',
    'laptop' => 'required',
    'tanggal_mulai' => 'required|date',
    'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
]);

$tugas = new Tugas();
$tugas->user_id = $request->user_id; // simpan ID user
$tugas->laptop = $request->laptop;
$tugas->tanggal_mulai = $request->tanggal_mulai;
$tugas->tanggal_selesai = $request->tanggal_selesai;
$tugas->save();

        return redirect()->route('tugas')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
{
    $tugas = Tugas::findOrFail($id);  // ambil tugas yang mau diedit
    $users = \App\Models\User::all(); // ambil semua user untuk dropdown

    return view('admin.tugas.edit', [
        'title' => 'Edit Tugas',
        'tugas' => $tugas,
        'users' => $users, // wajib dikirim
    ]);
}

    public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'laptop' => 'required',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $tugas = Tugas::findOrFail($id);
    $tugas->user_id = $request->user_id;
    $tugas->laptop = $request->laptop;
    $tugas->tanggal_mulai = $request->tanggal_mulai;
    $tugas->tanggal_selesai = $request->tanggal_selesai;
    $tugas->save();

    return redirect()->route('tugas')->with('success', 'Data tugas berhasil diperbarui');
}

public function destroy($id)
{
    $tugas = Tugas::findOrFail($id);
    $tugas->delete();

    return redirect()->route('tugas')->with('success', 'Data tugas berhasil dihapus');
}
}