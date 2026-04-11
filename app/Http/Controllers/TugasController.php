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
            'title' => 'Data tugas',
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

        return view('karyawan.tugas.index', $data);
        }
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Data tugas',
            'menuatugasuser' => 'active',
        );

        return view('admin/tugas/create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'jabatan' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada',
            'jabatan.required' => 'Jabatan harus di pilih',
            'password.required' => 'password tidak boleh kosong',
            'password.confirmed' => 'password konfirmasi tidak sama',
            'password.min' => 'password minimal 8 karakter',
        ]);

        $user = new Tugas;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->password = Hash::make($request->password);
        $user->is_tugas = false;
        $user->save();

        return redirect()->route('user')->with('success', 'Data berhasil ditambahkan');
    }
}